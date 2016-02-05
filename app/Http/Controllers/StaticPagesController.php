<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;

class StaticPagesController extends Controller
{
    public function getIndex($link)
    {
        return $this->getStaticPage($link);
    }

    protected function getStaticPage($link)
    {
        $page = Page::where("link", "=", $link)->first();
        // if (!$page->is_publish) {
        //     return redirect('/');
        // }

        $options = [
            'menus' => IndexController::menus(),
            'page' => $page,
        ];
        return view("static", $options);
    }
}
