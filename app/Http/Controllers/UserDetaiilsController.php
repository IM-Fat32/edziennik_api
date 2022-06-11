<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use App\Http\Requests\StoreUserDetailsRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use \Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDetaiilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = UserDetails::all();

        $filteredUsersData = $allUsers->filter(function ($user) {
            return $user->user_id;
            if ($user->user_id === Auth::id()) {
                return true;
            }
        })->values();

        return $filteredUsersData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDetailsRequest $request)
    {
        $requestData = $request->all();
        return UserDetails::create($requestData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Response  $request
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetails $userDetails)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserDetailsRequest  $request
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserDetailsRequest $request, UserDetails $userDetails)
    {
        $requestData = $request->all();
        $datetime = Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $userDetails->update($requestData);
        return $userDetails;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetails $userDetails)
    {
        $userDetails->delete();
        return response('', 204);
    }
}
