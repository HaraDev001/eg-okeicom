<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lesson_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('cancel_id')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('coupon_price')->nullable();
            $table->unsignedInteger('cancel_price');
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
        Schema::dropIfExists('applications');
    }
}
