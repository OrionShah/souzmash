<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\news;

use Auth;

class AdminController extends Controller
{
    public function getIndex()
    {
        return view('admin.index');
    }

    public function getNews($action = "get")
    {
        switch ($action) {
            case 'get':
                return $this->showNewsList();
                break;
            case 'new':
                return $this->showAddPage();
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
        $options = [
            "news" => $news,
            "count" => $count
        ];
        return view('admin.news', $options);
    }

    public function postNews($action)
    {
        print_r($action);die;
    }

    public function getAddNew()
    {
    	print_r('sdfdsfsdf');die;
    }

    public function postAddnew(Request $request)
    {
        $data = $request->all();
        $data['editor'] = htmlspecialchars($data['editor']);
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
        $allowed_fields = ['title', 'content', 'is_publish', 'preview', 'comments', 'author'];
        foreach ($data as $key => $value) {
        	if (in_array($key, $allowed_fields)) {
        		$new_record[$key] = $value;
        	}
        }
        $new_record->save();
        return redirect('admin/news');
    }
}
