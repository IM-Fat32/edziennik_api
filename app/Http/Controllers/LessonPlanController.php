<?php

namespace App\Http\Controllers;

use App\Models\LessonPlan;
use App\Http\Requests\StoreLessonPlanRequest;
use App\Http\Requests\UpdateLessonPlanRequest;
use \Carbon\Carbon;

class LessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LessonPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLessonPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonPlanRequest $request)
    {
        return LessonPlan::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonPlan  $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function show(LessonPlan $lessonPlan)
    {
        return $lessonPlan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLessonPlanRequest  $request
     * @param  \App\Models\LessonPlan  $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonPlanRequest $request, LessonPlan $lessonPlan)
    {
        $requestData = $request->all();
        $datetime= Carbon::now();
        $requestData['updated_at'] = $datetime->toDateTimeString();
        $lessonPlan->update($requestData);
        return $lessonPlan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonPlan  $lessonPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonPlan $lessonPlan)
    {
        $lessonPlan->delete();
        return response()
            ->json([
                'messagePL' => "Plan lekcji został usunięty",
                'messageEN' => "Lesson plan has been removed"
            ], 200);
    }
}
