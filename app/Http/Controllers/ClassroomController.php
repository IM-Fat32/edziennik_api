<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use \Carbon\Carbon;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Classroom::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        return Classroom::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $cLassroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return $classroom;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $cLassroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCLassroomRequest $request, CLassroom $classroom)
    {
        $requestData = $request->all();
        $datetime = Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $classroom->update($requestData);
        return $classroom;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $cLassroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return response()
            ->json([
                'messagePL' => "Klasa została usunięta",
                'messageEN' => "Classroom has been removed"
            ], 200);
    }
}
