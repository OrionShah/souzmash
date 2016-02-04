<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\news;
use App\Comments;

class IndexPostController extends Controller
{
    public function getIndex($id)
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
            'menus' => IndexController::menus(),
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
}
