<?php

namespace App\Http\Controllers;

use App\Models\UserWallet;
use App\Http\Requests\StoreUserWalletRequest;
use App\Http\Requests\UpdateUserWalletRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , User $user)
    {
        $wallet = $this->larafyTable($request ,UserWallet::class , UserWallet::where('user_id' , $user->id));
        return view( 'user-wallet.index' , compact('wallet' , 'user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserWalletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserWalletRequest $request , User $user)
    {
        // check role
        $this->role("create_users_wallet");
        // create wallet
        $data = $request->validated();
        $data['added_by_user_id'] = Auth::user()->id;
        $data['user_id'] = $user->id;

        UserWallet::create($data);

        session()->flash('success', __('messages.added_successfully'));
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserWallet  $userWallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWallet $userWallet)
    {
        $userWallet->delete();
        session()->flash('success', __('messages.deleted_successfully'));
        return back();
    }
}
