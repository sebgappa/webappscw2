<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;
use App\User;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'title' => 'required|max:100'
        ],
        [
            'description.required' => 'The page description must not be empty.',
            'title.required' => 'The page title must not be empty.'
        ]);

        $page = new Page;
        $page->description = $request->description;
        $page->title = $request->title;
        $page->user_id = Auth::user()->id;

        $page->save();
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

    public function getPageUsers($pageId) {
        $page = Page::where('id', $pageId)->get()->first();
        $userIds = $page->users->pluck('id')->toArray();
        $paginatedUsers = User::whereIn('id', $userIds)->paginate(5);

        return response()->json($paginatedUsers, '200');
    }

    public function view($id) {
        $page = Page::where('id', $id)->get()->first();

        if($page == null) {
            abort('404');
        };

        return view('page.show', ['pageId' => $id]);
    }
}
