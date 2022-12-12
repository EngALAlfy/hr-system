<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    function home()
    {
        // today posts
        // $posts = Post::whereDate('created_at', Carbon::today())->latest()->get();
        $posts = Post::whereMonth('created_at', Carbon::today()->month)->latest()->get();
        // abset users
        $absentUsers = User::whereHas('attendance' , function ($query){
            return $query->whereDate('created_at' , Carbon::today())->where('situation' , 'absent');
        })->select('id' , 'name' , 'job_title' , 'project_id')->selectRaw('((select sum(`user_rates`.`rate`) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = '.Carbon::now()->month.')/(select count(*) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = '.Carbon::now()->month.' )) as `rate`')->get();

        $yesterday_absent_count = User::whereHas('attendance' , function ($query){
            return $query->whereDate('created_at' , Carbon::yesterday())->where('situation' , 'absent');
        })->count();
        // branches count
        $branches_count = Branch::count();
        // projects count
        $projects_count = Project::count();
        // users count
        $users_count = User::count();
        // top ratings users
        $topRatingUsers = User::select('id', 'name', 'project_id')->selectRaw('((select sum(`user_rates`.`rate`) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = ' . Carbon::now()->month . ')/(select count(*) from `user_rates` where `users`.`id` = `user_rates`.`user_id` and MONTH(`created_at`) = ' . Carbon::now()->month . ' )) as `rate`')->orderBy('rate' , 'desc')->limit(5)->get();

        return view('home.index', compact('posts','yesterday_absent_count', 'absentUsers', 'branches_count', 'projects_count', 'topRatingUsers', 'users_count'));
    }
}
