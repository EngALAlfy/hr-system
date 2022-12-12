<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('user')->get();
        return view('pages.all', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->validated();

        $page = new Page;
        $slug =Str::slug($data['name']);;
        $page->name = $data['name'];
        $page->title = $data['title'];
        $page->content = $data['content'];
        $page->slug = $slug;
        $page->user_id = Auth::user()->id;

        $page->save();



        return redirect()->route('admin.pages.index')->with('success' , 'تم اضافة الصفحه بنجاح');
    }

    /**
     * Display the page after the post is missing.
     * for api
     * plain html page
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function showMissingApi(Request $request){
        $slug = $request->route()->parameter('post');
        $page = Page::where('slug' , $slug)->first();
        return response()->view('pages.show-api' , compact('page'));
    }

    /**
     * Display the page after the post is missing.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function showMissing(Request $request){
        $slug = $request->route()->parameter('post');
        $page = Page::where('slug' , $slug)->firstOrFail();
        return response()->json($page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
        $page->delete();
        return redirect()->back()->with('success' , 'تم حذف صفحه : '.$page->title);
    }
}
