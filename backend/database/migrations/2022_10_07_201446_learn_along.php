<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("instructor_id")->unsigned();
            $table->foreign('instruuctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('announcments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("course_id")->unsigned();
            $table->string("title");
            $table->string("description");
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("course_id")->unsigned();
            $table->string("title");
            $table->string("description");
            $table->date("due_date");
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('enrolls', function (Blueprint $table) {
            $table->integer("student_id")->unsigned();
            $table->integer("course_id")->unsigned();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('student_assignments', function (Blueprint $table) {
            $table->integer("student_id")->unsigned();
            $table->integer("assignment_id")->unsigned();
            $table->string("assignment");
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('announcments');
        Schema::dropIfExists('student_assignments');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('enrolls');
        Schema::dropIfExists('courses');
    }
};
