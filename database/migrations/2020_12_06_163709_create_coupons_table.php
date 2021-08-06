<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('publisher');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('discount');
            $table->date('expiration_get')->nullable();
            $table->date('expiration_publish')->nullable();
            $table->unsignedTinyInteger('category1_id')->nullable();
            $table->unsignedTinyInteger('category2_id')->nullable();
            $table->unsignedTinyInteger('category3_id')->nullable();
            $table->unsignedTinyInteger('category4_id')->nullable();
            $table->unsignedTinyInteger('category5_id')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
