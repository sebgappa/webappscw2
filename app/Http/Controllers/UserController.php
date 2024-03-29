<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Page;
use App\Post;
use App\Comment;

class UserController extends Controller
{
    public function createdPages($id) {
        $user = User::find($id);
        $pageIds = $user->createdPages->pluck('id')->toArray();
        $paginatedPages = Page::whereIn('id', $pageIds)->latest()->paginate(5);

        foreach ($paginatedPages as $page) {
            $page->username = User::find($page->user_id)->name;
            $page->tag;
        };

        return response()->json($paginatedPages, '200');
    }

    public function memberPages($id) {
        $user = User::find($id);
        $pageIds = $user->pages->pluck('id')->toArray();
        $paginatedPages = Page::whereIn('id', $pageIds)->latest()->paginate(5);

        foreach ($paginatedPages as $page) {
            $page->username = User::find($page->user_id)->name;
            $page->tag;
        };

        return response()->json($paginatedPages, '200');
    }

    public function posts($id) {
        $user = User::find($id);
        $postIds = $user->posts->pluck('id')->toArray();
        $paginatedPosts = Post::whereIn('id', $postIds)->latest()->paginate(5);

        return response()->json($paginatedPosts, '200');
    }

    public function comments($id) {
        $user = User::find($id);
        $commentIds = $user->comments->pluck('id')->toArray();
        $paginatedComments = Comment::whereIn('id', $commentIds)->latest()->paginate(5);

        return response()->json($paginatedComments, '200');
    }

    public function joinPage($id, $pageId) {
        if(!$id == Auth::user()->id) {
            abort('401');
        };

        $user = User::find($id);

        if($user->pages()->find($pageId)) {
            abort('400');
        };

        $page = Page::find($pageId);

        $user->pages()->save($page);
    }

    public function admin() {
        if(Auth::user()->admin()->exists()) {
            return response()->json(true, '200');
        };

        return response()->json(false, '200');
    }
}
