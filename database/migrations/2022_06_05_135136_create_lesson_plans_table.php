<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_plans', function (Blueprint $table) {
            $table->id();
            $table->date('lesson_date');
            $table->time('lesson_time');
            $table->foreignIdFor(\App\Models\Classroom::class, 'lesson_class_room');
            $table->foreignIdFor(\App\Models\Subject::class, 'lesson_subject');
            $table->foreignIdFor(\App\Models\User::class, 'lesson_teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_plans');
    }
};
