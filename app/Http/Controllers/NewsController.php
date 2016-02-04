<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\news;
use App\User;
use App\Comments;

use Auth;

class NewsController extends Controller
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

    public function getNew()
    {
        return view('admin.add');
    }

    public function postNew(Request $req)
    {
        $data = $req->all();
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

    public function getEdit($id)
    {
        $new = news::find($id);
        $new->content = trim($new->content);
        $options = [
            'new' => $new
        ];
        return view("admin.edit", $options);
    }

    public function postEdit(Request $req)
    {
        $data = $req->all();
        $record = news::find($data['id']);
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

    public function postDelete(Request $req)
    {
        $data = $req->all();
        $record = news::find($data['id']);
        $record->delete();
        return redirect('/admin/news/');
    }
}
