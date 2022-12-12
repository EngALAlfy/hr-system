<?php

namespace App\Http\Controllers;

use App\Models\UserRate;
use App\Http\Requests\StoreUserRateRequest;
use App\Http\Requests\UpdateUserRateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $ratings = $this->larafyTable($request, UserRate::class , UserRate::where('user_id', $user->id), [], []);
        return view('user-ratings.index', compact('ratings', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRateRequest $request, User $user)
    {
        // check role
        $this->role("create_users_ratings");
        //check rate by user one time in the month
        $rateInThisMonth = UserRate::where('user_id', $user->id)->where('rated_by_user_id', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->first();
        if (isset($rateInThisMonth)) {
            session()->flash('error', __('messages.rate_onetime_in_the_month'));
            return back();
        }
        // create rate
        $data = $request->validated();
        $data['rated_by_user_id'] = Auth::user()->id;
        $data['user_id'] = $user->id;

        UserRate::create($data);

        session()->flash('success', __('messages.rated_successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRate  $userRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRate $userRate)
    {
        $userRate->delete();
        session()->flash('success', __('messages.deleted_successfully'));
        return back();
    }
}
