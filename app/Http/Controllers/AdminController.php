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

    public function getIndex()
    {
        $comments = Comments::paginate(10);
        foreach ($comments as $key => $comment) {
            $comment->post_id = $comment->getPostId();
            $comments[$key] = $comment;
        }

        $options = [
            'comments' => $comments
        ];
        return view('admin.index', $options);
    }
}
