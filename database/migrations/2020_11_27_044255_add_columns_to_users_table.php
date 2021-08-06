<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account')->after('password');
            $table->unsignedTinyInteger('status')->nullable()->after('account');
            $table->unsignedTinyInteger('is_teacher')->default(0)->after('status');
            $table->unsignedTinyInteger('sex')->default(0)->after('is_teacher');
            $table->unsignedTinyInteger('age')->nullable()->after('sex');
            // $table->unsignedTinyInteger('country_id')->nullable()->after('age');
            $table->string('country_id')->nullable()->after('age');
            $table->unsignedInteger('prefecture_id')->nullable()->after('country_id');
            // $table->unsignedInteger('language_id')->nullable()->after('prefecture_id');
            $table->string('language_id')->nullable()->after('prefecture_id');
            $table->string('img')->nullable()->after('language_id')->default('no-image-user.png');
            $table->string('profile', 1000)->nullable()->after('img');
            $table->unsignedTinyInteger('mailing')->after('profile');
            $table->unsignedTinyInteger('bank_type')->nullable()->after('mailing');
            $table->unsignedInteger('bank_id')->nullable()->after('bank_type');
            $table->unsignedInteger('credit_id')->nullable()->after('bank_id');
            $table->unsignedTinyInteger('category1_id')->nullable()->after('credit_id');
            $table->unsignedTinyInteger('category2_id')->nullable()->after('category1_id');
            $table->unsignedTinyInteger('category3_id')->nullable()->after('category2_id');
            $table->unsignedTinyInteger('category4_id')->nullable()->after('category3_id');
            $table->unsignedTinyInteger('category5_id')->nullable()->after('category4_id');
            $table->string('withdraw_reason')->nullable()->after('category5_id');
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
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('account');
            // $table->dropColumn('status');
            // $table->dropColumn('sex');
            // $table->dropColumn('age');
            // $table->dropColumn('country_id');
            // $table->dropColumn('prefecture_id');
            // $table->dropColumn('language_id');
            // $table->dropColumn('img');
            // $table->dropColumn('profile');
            // $table->dropColumn('mailing');
            // $table->dropColumn('bank_type');
            // $table->dropColumn('bank_id');
            // $table->dropColumn('credit_id');
            // $table->dropColumn('category1_id');
            // $table->dropColumn('category2_id');
            // $table->dropColumn('category3_id');
            // $table->dropColumn('category4_id');
            // $table->dropColumn('category5_id');
            // $table->dropColumn('withdraw_reason');
            $table->dropSoftDeletes();
        });
    }
}
