<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others_banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('financial_name');
            $table->string('branch_name');
            $table->string('branch_number', 3);
            $table->unsignedTinyInteger('type')->default(1);
            $table->unsignedInteger('number');
            $table->string('name');
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
        Schema::dropIfExists('others_banks');
    }
}
