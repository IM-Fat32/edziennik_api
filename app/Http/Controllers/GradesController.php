<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use App\Models\Subject;
use App\Models\UserDetails;
use App\Models\User;
use App\Http\Requests\StoreGradesRequest;
use App\Http\Requests\UpdateGradesRequest;
use \Illuminate\Http\Request;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allGrades = Grades::all();
        $filteredGrades = $allGrades->filter(function ($grade)  use ($request) {
            if ($grade->user_id === intval($request->user_id)) {
                return true;
            }
        })->values();

        $expandedGrades = $filteredGrades->map(function ($grade) {
            $subjectData = Subject::find($grade->subject_id);
            $grade['subjectName'] = " ";

            if (!is_null($subjectData)) {}
                $grade['subjectName'] = $subjectData->subject_name;

            return $grade;
        });

        return $expandedGrades;
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
        $datetime = Carbon::now();
        $requestData['last_modificated'] = $datetime->toDateTimeString();
        return Grades::create($requestData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Grades $grades)
    {
        $grade = Grades::find($request->id);
        return $grade;
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
        $grade = Grades::find($request->id);
        $datetime = Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $requestData['last_modificated'] = $datetime->toDateTimeString();
        $grade->update($requestData);
        return $grade;
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
        return response()
            ->json([
                'messagePL' => "Ocena została usunięta",
                'messageEN' => "Grade has been removed"
            ], 200);
    }
}
