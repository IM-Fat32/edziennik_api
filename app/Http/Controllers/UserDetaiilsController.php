<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use App\Http\Requests\StoreUserDetailsRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use \Illuminate\Http\Response;
use \Illuminate\Http\Request;
use \Carbon\Carbon;

class UserDetaiilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $datetime = Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $requestData['created_at'] = $datetime->toDateTimeString();
        $createdData = UserDetails::create($requestData);
        return response()
            ->json([
                'createdData' => $createdData,
                'messagePL' => "Tworzenie danych użytkownika przebiegło pomyślnie",
                'messageEN' => "Creation of user data was successful"
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserDetails $userDetails)
    {
        $allUsers = UserDetails::All();
        $filteredUsers = $allUsers->filter(function ($user) use ($request) {
            if ($user->user_id === intval($request->user_id))
                return true;
        });

        if (count($filteredUsers->values()) > 0)
            return $filteredUsers->first();

        return [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserDetailsRequest $request, UserDetails $userDetails)
    {
        $requestData = $request->all();
        $datetime = Carbon::now();
        $userDetailsData = $this->getUserDetialsObject($request);
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $requestData['user_id'] = $request->user_id;
        $userDetailsData->update($requestData);
        return $userDetailsData;
    }

    private function getUserDetialsObject($request)
    {
        $allUsers = UserDetails::All();
        $filteredUsers = $allUsers->filter(function ($user) use ($request) {
            if ($user->user_id === intval($request->user_id))
                return true;
        });


        $userDetailsData = UserDetails::find($filteredUsers->first()->id);
        return $userDetailsData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserDetails $userDetails)
    {
        $userDetails = $this->getUserDetialsObject($request);
        $userDetails->delete();
        return response()
            ->json([
                'messagePL' => "Dane użytkownika zostały usunięte",
                'messageEN' => "User data has been removed"
            ], 200);
    }
}
