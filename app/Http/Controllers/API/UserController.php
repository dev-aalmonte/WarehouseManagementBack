<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function login(Request $request){
        if( auth()->attempt(['email' => $request->email, 'password' => $request->password]) ){
            $user = auth()->user();
            $user->api_token = str_random(60);
            $user->save();

            return $user;
        }

        return ['error' => 'Unauthenticated User', 'code' => 401];
    }

    public function logout(Request $request){
        if (auth()->user()){
            $user = auth()->user();
            $user->api_token = null;
            $user->save();

            return ['message' => 'success'];
        }

        return ['error' => 'Unable to logout', 'code' => 401];
    }

    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
