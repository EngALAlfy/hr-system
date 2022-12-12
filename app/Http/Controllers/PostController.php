<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Branch;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project = null)
    {
        $posts = $this->larafyTable($request, Post::class , null , ['branch', 'project'], ['name']);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branch $branch  = null, Project $project = null)
    {
        if ($branch == null && $project == null) {
            $branches = Branch::with('projects')->get()->keyBy('id');
            return view('posts.create', compact('branches'));
        } else if ($branch != null && $project != null) {
            return view('posts.create', compact('branch', 'project'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        $photo = $data['photo'];
        if (isset($photo)) {
            $photoname = Time() . "-" . $photo->getClientOriginalName();
            $dirname = "photos" . "/" . $data["branch_id"] . "/" . $data["project_id"];
            $photo->storePubliclyAs($dirname, $photoname, 'public');
            $data["photo"] = $photoname;
        }

        Post::create($data);

        session()->flash('success', __('messages.added_successfully'));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Branch $branch = null, Project $project = null)
    {
        if ($branch == null && $project == null) {
            $branches = Branch::with('projects')->get();
            return view('posts.edit', compact('branches', 'post'));
        } else if ($branch != null && $project != null) {
            return view('posts.edit', compact('branch', 'project', 'post'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        $photo = $data['photo'];
        if (isset($photo)) {
            Storage::disk('public')->delete("photos" . "/" . $post->branch_id . "/" . $post->project_id . "/" . $post->photo);
            $photoname = Time() . "-" . $photo->getClientOriginalName();
            $dirname = "photos" . "/" . $data["branch_id"] . "/" . $data["project_id"];
            $photo->storePubliclyAs($dirname, $photoname, 'public');
            $data["photo"] = $photoname;
        }

        $post->update($data);

        session()->flash('success', __('messages.updated_successfully'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete("photos" . "/" . $post->branch_id . "/" . $post->project_id . "/" . $post->photo);
        $post->delete();
        session()->flash('success', __('messages.deleted_successfully'));
        return back();
    }
}
