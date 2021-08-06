<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id');
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('public');
            $table->unsignedTinyInteger('type');
            $table->string('view', 64);
            $table->string('url', 100)->nullable();
            $table->string('slide', 100)->nullable();
            $table->date('date');
            $table->time('start');
            $table->time('finish');
            $table->unsignedInteger('price');
            $table->unsignedTinyInteger('cancel_rate');
            $table->string('title');
            $table->string('detail', 1000)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
