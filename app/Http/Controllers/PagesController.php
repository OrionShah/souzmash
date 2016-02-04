<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;

use Auth;

class PagesController extends Controller
{

    private $allowed_fields = ['title', 'content', 'is_publish', 'author', 'link'];

    public function getIndex()
    {
        $pages = Page::paginate(10);
        $options = [
            'pages' => $pages,
            'count' => $pages->count()
        ];
        return view('admin.pages', $options);
    }

    public function getNew()
    {
        return view('admin.new_page');
    }

    public function postNew(Request $req)
    {
        $data = $req->all();
        $page = new Page;
        if (!isset($data['is_publish'])) {
            $data['is_publish'] = (bool)0;
        } else {
            $data['is_publish'] = (bool)1;
        }

        $data['content'] = (string)$data['editor'];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowed_fields)) {
                $page[$key] = $value;
            }
        }

        $page->save();
        return redirect('admin/pages');
    }

    public function getEdit($id)
    {
        $page = Page::find($id);

        $options = [
            'page' => $page
        ];
        return view('admin.edit_page', $options);
    }

    public function postEdit(Request $req)
    {
        $data = $req->all();
        $page = Page::find($data['id']);
        if (!isset($data['is_publish'])) {
            $data['is_publish'] = (bool)0;
        } else {
            $data['is_publish'] = (bool)1;
        }
        $data['content'] = (string)$data['editor'];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowed_fields)) {
                $page[$key] = $value;
            }
        }

        $page->save();
        return redirect('admin/pages/edit/' . $data['id']);
    }

    public function postDelete(Request $req)
    {
        $data = $req->all();
        $page = Page::find($data['id']);
        $page->delete();
        return redirect('admin/pages');
    }
}
