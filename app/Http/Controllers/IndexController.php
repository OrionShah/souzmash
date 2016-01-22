<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

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
        $menu = [
            ["text"=> "Главная", "link" => "/"],
            ["text"=> "link2", "link" => "/link2"],
            ["text"=> "link3", "link" => "/link3"]
        ];
        return view('index', ["menus" => $menu]);
    }

    public function getRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        $menu = [
            ["text"=> "Главная", "link" => "/"],
            ["text"=> "link2", "link" => "/link2"],
            ["text"=> "link3", "link" => "/link3"]
        ];
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
}
