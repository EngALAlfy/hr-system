<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProjectRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\ErrorHandler\Collecting;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->larafyTable($request, User::class ,User::select('*')->selectRaw('((select sum(`user_rates`.`rate`) from `user_rates` where `users`.`id` = `user_rates`.`user_id`)/(select count(*) from `user_rates` where `users`.`id` = `user_rates`.`user_id`)) as `rate`')->withSum('wallet' , 'amount'), [] , []);
        return view('users.index', compact('users'));
    }

    public function projects(Request $request)
    {
        $users = $this->larafyTable($request, User::class , User::select('id' , 'name' , 'project_id'), [] , []);
        $projects = Project::latest()->get();
        return view('users.projects', compact('users' , 'projects'));
    }

    public function changeProject(StoreUserProjectRequest $request ,  User $user)
    {
        $data = $request->validated();
        $user->project_id = $data['project_id'];
        $user->save();

        session()->flash('success', __('messages.updated_successfully'));
        return redirect()->route('users.projects');
    }


    public function monthlyRatings(Request $request)
    {
        $users = $this->larafyTable($request, User::select('id' , 'name' , 'project_id')->selectRaw('((select sum(`user_rates`.`rate`) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = '.Carbon::now()->month.')/(select count(*) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = '.Carbon::now()->month.' )) as `rate`'), [] , []);
        return view('users.monthly-ratings', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::latest()->get();
        return view('users.create' , compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $photo = $data['photo'];
        if (isset($photo)) {
            $photoname = Time() . "-" . $photo->getClientOriginalName();
            $dirname = "photos/users/";
            $photo->storePubliclyAs($dirname, $photoname, 'public');
            $data["photo"] = $photoname;
        }

        $user = User::create($data);

        if(isset($data['roles'])){
            $user->attachRoles($data['roles']);
        }

        session()->flash('success', __('messages.added_successfully'));
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $projects = Project::latest()->get();
        return view('users.edit' , compact('projects' , 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validated();

        $photo = $data['photo'];
        if (isset($photo)) {
            Storage::disk('public')->delete("photos/users/" . $user->photo);
            $photoname = Time() . "-" . $photo->getClientOriginalName();
            $dirname = "photos/users/";
            $photo->storePubliclyAs($dirname, $photoname, 'public');
            $data["photo"] = $photoname;
        }

        $user->update($data);

        if(isset($data['roles'])){
            $user->attachRoles($data['roles']);
        }

        session()->flash('success', __('messages.updated_successfully'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::disk('public')->delete("photos/users/" . $user->photo);
        $user->delete();
        session()->flash('success', __('messages.deleted_successfully'));
        return back();
    }
}
