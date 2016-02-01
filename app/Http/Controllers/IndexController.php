<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\news;

class IndexController extends Controller
{
    // function __construct()
    // {
        // $this->middleware('auth', ["only" => ]);
    // }
    
    /**
     * Метод главной страницы
     *
     * @return view главная
     */
    public function getIndex()
    {
        $menu = $this->menus();
        $posts = news::paginate(10);
        foreach ($posts as $key => $post) {
            if (strlen($post->content) > 150) {
                $post->content = substr($post->content, 0, 100) . "...";
            }
            $post->time = $post->created_at->format('d.m.Y H:i');
            $posts[$key] = $post;
        }
        $options = [
            'menus' => $menu,
            'posts' => $posts
        ];
        return view('index', $options);
    }

    public function getRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        $menu = $this->menus();
        return view('register', ["menus" => $menu]);
    }

    public function postLogin(Request $req)
    {
        $email = $req->input("email");
        $password = $req->input("password");
        $valid = $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = Auth::attempt(['email' => $email, 'password' => $password], true);
        if ($user) {
            return redirect('/');
        } else {
            return redirect('/');
        }
    }

    public function getPost($id)
    {
        $post = news::find($id);
        if (!$post) {
            return;
        }

        $options = [
            'post' => $post,
            'menus' => $this->menus(),
        ];
        return view('post', $options);
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getTest()
    {
        echo "<pre>";
        print_r(Auth::check() . "<br>");
        print_r(Auth::user());die;
    }

    public function postIndex(Request $req)
    {
       return ['text' => 'Совсем с ума сошел?'];
    }

    public function menus()
    {
        $menu = [
            ["text"=> "Главная", "link" => "/"],
            ["text"=> "link2", "link" => "/link2"],
            ["text"=> "link3", "link" => "/link3"]
        ];
        return $menu;
    }
}
