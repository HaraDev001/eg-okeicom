<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('title', 255);
            $table->string('detail', 1000)->nullable();
            $table->unsignedTinyInteger('category1_id')->nullable();
            $table->unsignedTinyInteger('category2_id')->nullable();
            $table->unsignedTinyInteger('category3_id')->nullable();
            $table->unsignedTinyInteger('category4_id')->nullable();
            $table->unsignedTinyInteger('category5_id')->nullable();
            $table->string('img1')->nullable()->default('no-image-course.png');
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->string('img5')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
