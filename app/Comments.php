<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Comments extends Model
{
    protected $table = "comments";

    protected $fillable = [
        'author', 'text'
    ];

    public function getAuthorAttribute($value)
    {
        $user = User::find($value);
        return $user->name;
    }


    public function getPostId()
    {
        return $this->attributes['post'];
    }

    public function getPostAttribute($value)
    {
        $post = news::find($value);
        return $post->title;
    }
}
