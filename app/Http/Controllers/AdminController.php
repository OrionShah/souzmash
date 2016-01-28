<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\news;
use App\User;

use Auth;

class AdminController extends Controller
{
    private $allowed_fields = ['title', 'content', 'is_publish', 'preview', 'comments', 'author'];

    public function getIndex()
    {
        return view('admin.index');
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

    public function showAddPage()
    {
        return view('admin.add');
    }

    public function showNewsList()
    {
        $news = news::all();
        $count = $news->count();
        foreach ($news as $new) {
            $new->author = User::find($new->author)->name;

            // $new->created_at = date('H:i d.m.Y', $new->created_at);
            // $new->updated_at = date('H:i d.m.Y', $new->updated_at);
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
                $data['is_publish'] = (bool)0;
            } else {
                $data['is_publish'] = (bool)1;
            }
            if(!isset($data['commnets'])) {
                $data['commnets'] = (bool)0;
            } else {
                $data['commnets'] = (bool)1;
            }
            $data['content'] = (string)$data['editor'];
            foreach ($data as $key => $value) {
                if (in_array($key, $this->allowed_fields)) {
                    $record[$key] = $value;
                }
            }
            $record->save();
            return redirect("/admin/news/edit/" . $data['id']);
        }
    }

    public function getAddNew()
    {
    	print_r('sdfdsfsdf');die;
    }

    public function postAddnew(Request $request)
    {
        $data = $request->all();
        // $data['editor'] = htmlspecialchars($data['editor']);
        if (!isset($data['is_publish'])) {
        	$data['is_publish'] = (bool)0;
        } else {
        	$data['is_publish'] = (bool)1;
        }
        if(!isset($data['commnets'])) {
        	$data['commnets'] = (bool)0;
        } else {
        	$data['commnets'] = (bool)1;
        }
        $data['content'] = (string)$data['editor'];
        $data['author'] = Auth::user()->id;
        // echo "<pre>";
        // print_r($data);die;
        $new_record = new news;
        
        foreach ($data as $key => $value) {
        	if (in_array($key, $this->allowed_fields)) {
        		$new_record[$key] = $value;
        	}
        }
        $new_record->save();
        return redirect('admin/news');
    }
}
