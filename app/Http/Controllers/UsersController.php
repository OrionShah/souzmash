<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function getIndex()
    {
        $users = User::paginate(10);
        $options = [
            'users' => $users,
        ];
        return view("admin.users", $options);
    }

    public function postAdminstatus($user_id)
    {
        $user = User::find($user_id);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return redirect('admin/users');
    }
}
