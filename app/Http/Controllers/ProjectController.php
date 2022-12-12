<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = $this->larafyTable($request, Project::class , null , ['branch'] , ['name']);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branch $branch = null)
    {
        if ($branch == null) {
            $branches = Branch::all();
            return view('projects.create', compact('branches'));
        } else {
            return view('projects.create', compact('branch'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        Project::create($data);

        session()->flash('success' , __('messages.added_successfully'));
        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project , Branch $branch = null)
    {
        if ($branch == null) {
            $branches = Branch::all();
            return view('projects.edit', compact('branches' , 'project'));
        } else {
            return view('projects.edit', compact('branch' , 'project'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->update($data);

        session()->flash('success' , __('messages.added_successfully'));
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->posts()->delete();
        Storage::disk('public')->deleteDirectory("photos" . "/" . $project->id);
        $project->delete();
        session()->flash('success' , __('messages.deleted_successfully'));
        return back();
    }
}
