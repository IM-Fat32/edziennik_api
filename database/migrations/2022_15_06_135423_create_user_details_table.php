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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('phone_number')->unique()->nullable();
            $table->string('country');
            $table->string('postcode');
            $table->string('street');
            $table->string('city');
            $table->string('house_number');
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->bigInteger('user_type');
            $table->bigInteger('user_id');
            $table->foreignIdFor(\App\Models\SchoolClass::class, 'school_class')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
        
    }
};
