<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_others', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->comment('銀行ID')->constrained();
            $table->string('financial_name', 255)->comment('金融機関名');
            $table->string('branch_name', 255)->comment('支店名');
            $table->string('branch_number', 255)->comment('支店番号');
            $table->unsignedInteger('other_type')->comment('口座種別');
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
        Schema::dropIfExists('bank_others');
    }
}
