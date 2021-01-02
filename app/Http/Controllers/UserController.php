<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Post;
use App\Comment;

class UserController extends Controller
{
    public function pages($id) {
        $user = User::find($id);
        $pageIds = $user->pages->pluck('id')->toArray();
        $paginatedPages = Page::whereIn('id', $pageIds)->paginate(5);

        return response()->json($paginatedPages, '200');
    }

    public function posts($id) {
        $user = User::find($id);
        $postIds = $user->posts->pluck('id')->toArray();
        $paginatedPosts = Post::whereIn('id', $postIds)->paginate(5);

        return response()->json($paginatedPosts, '200');
    }

    public function comments($id) {
        $user = User::find($id);
        $commentIds = $user->comments->pluck('id')->toArray();
        $paginatedComments = Comment::whereIn('id', $commentIds)->paginate(5);

        return response()->json($paginatedComments, '200');
    }
}
