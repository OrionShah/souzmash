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
        $menu = [
            ["text"=> "Главная", "link" => "/"],
            ["text"=> "link2", "link" => "/link2"],
            ["text"=> "link3", "link" => "/link3"]
        ];
        return view('register', ["menus" => $menu]);
    }

    public function postRegister(Request $req)
    {
        print_r('expression');die;
        $valid = $this->validate($req, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_again' => 'required'
        ]);
        print_r($valid);die;
        return "Проверка пройдена";
    }


    public function postLogin()
    {

    }

    public function getTest()
    {
        
        var_dump(Auth::check());
    }

    public function postIndex(Request $req)
    {
       return ['text' => 'Совсем с ума сошел?'];
    }
}
