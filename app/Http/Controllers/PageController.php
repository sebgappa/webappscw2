<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Page;
use App\User;
use App\Tag;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excludedPages = User::find(Auth::user()->id)->pages()->pluck('id');
        $pages = Page::whereNotIn('id', $excludedPages)->latest()->paginate(5);

        foreach ($pages as $page) {
            $page->username = User::find($page->user_id)->name;
        };

        return response()->json($pages, '200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:200',
            'title' => 'required|max:100',
            'tag' => 'required|max:20',
        ],
        [
            'description.required' => 'The page description must not be empty.',
            'title.required' => 'The page title must not be empty.',
            'tag.required' => 'The page needs a tag.',
        ]);

        $page = new Page;
        $page->description = $request->description;
        $page->title = $request->title;
        $page->user_id = Auth::user()->id;
        $page->save();

        $tag = new Tag(['name' => $request->tag]);
        $pageTag = Page::find($page->id); 
        $pageTag->tag()->save($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::where('id', $id)->get()->first();
        $page->username = User::find($page->user_id)->name; 

        return response()->json($page, '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if(($page->user_id != Auth::user()->id) && (Auth::user()->admin()->exists() == false)) {
            abort('401');
        }

        return $page->delete();
    }

    public function getPageUsers($pageId) {
        $page = Page::where('id', $pageId)->get()->first();
        $userIds = $page->users->pluck('id')->toArray();
        $paginatedUsers = User::whereIn('id', $userIds)->latest()->paginate(5);

        return response()->json($paginatedUsers, '200');
    }

    public function view($id) {
        $page = Page::where('id', $id)->get()->first();

        if($page == null) {
            abort(404);
        };

        return view('page.show', ['pageId' => $id]);
    }

    public function join() {
        return view('page.join');
    }
}
