<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Post;

class PageController extends Controller
{
    public function show($id) {
        $page = Page::where('id', $id)->get()->first();
        $posts = Post::where('page_id', $id)->paginate(10);

        return view('page.show', ['page' => $page, 'posts' => $posts]);
    }
}
