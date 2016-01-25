<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\news;

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
                $this->showNewsList();
                break;
            case 'new':
                $this->showAddPage();
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
}
