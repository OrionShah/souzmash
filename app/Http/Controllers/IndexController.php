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
    public function getIndex($link = false)
    {
        if ($link) {
            return $this->getStaticPage($link);
        }
        $menu = $this->menus();
        $posts = news::where('is_publish', '=', '1')->paginate(10);
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
            return redirect('/');
        }

        if (!$post->is_publish) {
            return redirect('/');
        }

        $options = [
            'post' => $post,
            'menus' => $this->menus(),
        ];
        if ($post->comments) {
            $comments = Comments::where('post', '=', $post->id);
            $comments_array = $comments->get();
            foreach ($comments_array as $key => $comment) {
                $comment->time = $comment->created_at->format("d.m.Y H:i");
                $comments_array[$key] = $comment;
            }
            $options['comments_count'] = $comments->count();
            $options['comments'] = $comments_array;
        }
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
        ];
        $pages = Page::where('is_publish', '=', true)->get();
        foreach ($pages as $page) {
            $menu[] = [
                "text" => $page->title,
                "link" => $page->link
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
        if (!$comment) return back();

        if ($comment->author != $data['user'] && !Auth::user()->is_admin) {
            return back();
        }

        $comment->delete();

        return back();
    }

    protected function getStaticPage($link)
    {
        $page = Page::where("link", "=", $link)->first();
        // if (!$page->is_publish) {
        //     return redirect('/');
        // }
        
        $options = [
            'menus' => $this->menus(),
            'page' => $page,
        ];
        return view("static", $options);
    }
}
