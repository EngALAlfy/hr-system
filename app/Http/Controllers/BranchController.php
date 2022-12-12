<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = $this->larafyTable($request , Branch::class , null);
        return view('branches.index' , compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        //
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        Branch::create($data);

        session()->flash('success' , __('messages.added_successfully'));
        return redirect()->route('branches.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit' , compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        //
        $data = $request->validated();

        $branch->update($data);

        session()->flash('success' , __('messages.updated_successfully'));
        return redirect()->route('branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->posts()->delete();
        $branch->projects()->delete();
        Storage::disk('public')->deleteDirectory("photos" . "/" . $branch->id);
        $branch->delete();
        session()->flash('success' , __('messages.deleted_successfully'));
        return back();
    }
}
