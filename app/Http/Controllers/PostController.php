<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pageId)
    {
        $posts = Post::where('page_id', $pageId)->latest()->paginate(10);

        foreach ($posts as $post) {
            $post->username = User::find($post->user_id)->name;
        };
        
        return response()->json($posts, '200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pageId, $id)
    {
        $post = Post::where(['id' => $id, 'page_id' => $pageId])->get()->first();
        $post->username = User::find($post->user_id)->name; 
        
        return response()->json($post, '200');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view($pageId, $postId) 
    {
        $post = Post::where(['id' => $postId, 'page_id' => $pageId])->get()->first();

        if ($post == null) {
            abort(404);
        };

        return view('post', ['postId' => $postId, 'pageId' => $pageId]);
    }
}
