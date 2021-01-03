<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Page;
use App\Tag;
use App\Image;

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
            $post->tag;
        };
        
        return response()->json($posts, '200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pageId)
    {
        $page = Page::where('id', $pageId)->get()->first();

        if($page == null) {
            abort('404');
        };

        return view('post.create', ['pageId' => $pageId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pageId)
    {
        $this->validate($request, [
            'body' => 'required|max:200',
            'title' => 'required|max:100',
            'tag' => 'required|max:20',
        ],
        [
            'body.required' => 'The page body must not be empty.',
            'title.required' => 'The page title must not be empty.',
            'tag.required' => 'The page needs a tag.',
        ]);

        $post = new Post;
        $post->body = $request->body;
        $post->title = $request->title;
        $post->synopsis = substr($request->body, 0, 150) . '...';
        $post->user_id = Auth::user()->id;
        $post->page_id = $pageId;
        $post->save();

        $tag = new Tag(['name' => $request->tag]);
        $postTag = Post::find($post->id); 
        $postTag->tag()->save($tag);

        return response()->json($post->id, '200');
    }

    public function saveImage(Request $request, $postId) {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png',
                ]);
                $name = $request->image->getClientOriginalName();
                $request->image->storeAs('/public', Auth::user()->name."-".$name);
                $url = Storage::url(Auth::user()->name."-".$name);
                $image = Image::create([
                    'image_path' => $url,
                    'post_id' => $postId 
                ]);
            }
        }
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
        $post->image; 
        
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
    public function destroy($pageId, $postId)
    {
        $post = Post::find($postId);

        if(!$post->user_id == Auth::user()->id) {
            abort('400');
        };

        return $post->delete();
    }

    public function view($pageId, $postId) 
    {
        $post = Post::where(['id' => $postId, 'page_id' => $pageId])->get()->first();

        if ($post == null) {
            abort(404);
        };

        return view('post.show', ['postId' => $postId, 'pageId' => $pageId]);
    }
}
