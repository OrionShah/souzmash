<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\news;
use App\Comments;
use App\Page;

class IndexController extends Controller
{

    /**
     * Метод главной страницы
     *
     * @return view главная
     */
    public function getIndex()
    {
        $menu = $this->menus();
        $posts = news::where('is_publish', '=', '1')->orderBy('created_at', 'desc')->paginate(10);
        foreach ($posts as $key => $post) {
            if (strlen($post->content) > 500) {
                $post->content = substr($post->content, 0, 500) . "...";
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
        $pass = $req->input("password");
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $valid = $this->validate($req, $rules);
        $user = Auth::attempt(['email' => $email, 'password' => $pass], true);
        return redirect('/');
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public static function menus()
    {
        $menu = [
            ["text" => "Главная", "link" => "/"],
        ];
        $pages = Page::where('is_publish', '=', true)->get();
        foreach ($pages as $page) {
            $menu[] = [
                "text" => $page->title,
                "link" => '/' . $page->link
            ];
        }

        return $menu;
    }

    public function postComment(Request $req)
    {
        if (!Auth::check()) {
            return redirect("/post/".$req->input('id'));
        }

        $data = $req->all();
        $comment = new Comments;
        $comment->post = $data['id'];
        $comment->text = $data['text'];
        $comment->author = Auth::user()->id;
        $comment->save();
        return redirect("/post/".$req->input('id'));
    }

    public function postDelcomment(Request $req)
    {
        if (!Auth::check()) {
            return back();
        }

        $data = $req->all();
        $comment = Comments::find($data['comment_Id']);
        if (!$comment) {
            return back();
        }

        if ($comment->author != $data['user'] && !Auth::user()->is_admin) {
            return back();
        }

        $comment->delete();

        return back();
    }

    
}
