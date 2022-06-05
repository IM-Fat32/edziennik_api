<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use App\Http\Requests\StoreGradesRequest;
use App\Http\Requests\UpdateGradesRequest;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class GradesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allGrades = Grades::all();
        $filteredGrades = $allGrades->filter(function ($grade) {
            return $grade->user_id;
            if ($grade->user_id === Auth::id()) {
                return true;
            }
        })->values();
        return $filteredGrades;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGradesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradesRequest $request)
    {   
        $requestData = $request->all();
        $datetime= Carbon::now();
        $requestData['last_modificated'] = $datetime->toDateTimeString();
        return Grades::create($requestData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function show(Grades $grades)
    {
        return $grades;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradesRequest  $request
     * @param  \App\Models\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradesRequest $request, Grades $grades)
    {
        $requestData = $request->all();
        $datetime= Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $requestData['last_modificated'] = $datetime->toDateTimeString();
        $grades->update($requestData);
        return $grades;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grades $grades)
    {
        $grades->delete();
        return response('', 204);
    }
}
