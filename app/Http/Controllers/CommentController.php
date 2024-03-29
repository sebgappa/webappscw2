<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)->latest()->paginate(10); 

        foreach ($comments as $comment) {
            $comment->username = User::find($comment->user_id)->name;
        };

        return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
        $this->validate($request, [
            'body' => 'required|max:300'
        ],
        [
            'body.required' => 'Your comment must not be empty.'
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;
        $comment->post_id = $postId;

        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId, $id)
    {
        $comment = Comment::find($id);

        if(($comment->user_id != Auth::user()->id) && (Auth::user()->admin()->exists() == false)) {
            abort('401');
        }

        return $comment->delete();
    }
}
