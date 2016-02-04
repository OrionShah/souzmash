<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\news;
use App\User;
use App\Comments;

use Auth;

class AdminController extends Controller
{
    private $allowed_fields = [
        'title',
        'content',
        'is_publish',
        'preview_image',
        'comments',
        'author'
    ];

    public function getIndex()
    {
        $comments = Comments::take(5)->get();
        foreach ($comments as $key => $comment) {
            $comment->post_id = $comment->getPostId();
            $comments[$key] = $comment;
        }

        $options = [
            'comments' => $comments
        ];
        return view('admin.index', $options);
    }

    public function getNews($action = "get", $id = null)
    {
        switch ($action) {
            case 'get':
                return $this->showNewsList();
                break;
            case 'new':
                return $this->showAddPage();
                break;
            case 'edit':
                return $this->showEditPage($id);
                break;
            default:
                # code...
                break;
        }

    }

    public function getUsers($action = "get")
    {
        switch ($action) {
            case 'get':
                return $this->showUsersList();
                break;
            default:
                # code...
                break;
        }
    }

    public function showAddPage()
    {
        return view('admin.add');
    }

    public function showNewsList()
    {
        $news = news::paginate(10);
        $count = $news->count();
        foreach ($news as $new) {
            $new->author = User::find($new->author)->name;
        }

        $options = [
            "news" => $news,
            "count" => $count
        ];
        return view('admin.news', $options);
    }

    public function showEditPage($id)
    {
        $new = news::find($id);
        $new->content = trim($new->content);
        $options = [
            'new' => $new
        ];
        return view("admin.edit", $options);
    }

    public function postNews($action, Request $req)
    {
        $data = $req->all();
        $record = news::find($data['id']);
        if ($action == "delete") {
            $record->delete();
            return redirect('/admin/news/');
        }

        if ($action == "edit") {
            if (!isset($data['is_publish'])) {
                $data['is_publish'] = false;
            } else {
                $data['is_publish'] = true;
            }

            if (!isset($data['comments'])) {
                $data['comments'] = false;
            } else {
                $data['comments'] = true;
            }

            $data['content'] = (string) $data['editor'];
            foreach ($data as $key => $value) {
                if (in_array($key, $this->allowed_fields)) {
                    $record[$key] = $value;
                }
            }

            $record->save();
            return redirect("/admin/news/edit/" . $data['id']);
        }
    }

    public function postAddnew(Request $request)
    {
        $data = $request->all();
        if (!isset($data['is_publish'])) {
            $data['is_publish'] = false;
        } else {
            $data['is_publish'] = true;
        }

        if (!isset($data['comments'])) {
            $data['comments'] = false;
        } else {
            $data['comments'] = true;
        }

        $data['content'] = (string) $data['editor'];
        $data['author'] = Auth::user()->id;
        $new_record = new news;
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowed_fields)) {
                $new_record[$key] = $value;
            }
        }

        $new_record->save();
        return redirect('admin/news');
    }

    public function showUsersList()
    {
        $users = User::paginate(10);
        $options = [
            'users' => $users,
        ];
        return view("admin.users", $options);
    }

    public function postChangeadminstatus($user_id)
    {
        $user = User::find($user_id);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect('admin/users');
    }
}
