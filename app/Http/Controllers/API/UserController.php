<?php

namespace App\Http\Controllers\API;

use App\User;

use App\Http\Requests\StoreUserPost;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        return ['error' => 'Unauthenticated User', 'code' => 401, 'request' => $request->all()];
    }

    public function logout(Request $request){
        $user = User::findOrFail($request->id);
        if ($user->api_token == $request->token) {
            $user->api_token = null;
            $user->save();

            return ['message' => 'success'];
        }

        return ['error' => 'Unable to logout', 'code' => 401];
    }

    public function showByToken($token) {
        $user = User::where('api_token', $token)->first();

        return $user;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        if(isset($request->search)) {
            return User::with('warehouse')->with('role')->where('first_name', 'like', '%'.$search.'%')->orWhere('last_name', 'like', '%'.$search.'%')->paginate(15);
        }
        return User::with('warehouse')->with('role')->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {

        $validated = $request->validated();

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->roleID = $request->roleID;
        $user->warehouseID = $request->warehouseID;

        $user->save();

        return $validated;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return User::with('warehouse')->with('role')->find($user->id);
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
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->roleID = $request->roleID;
        $user->warehouseID = $request->warehouseID;

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $user;
    }
}
