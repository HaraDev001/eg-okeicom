<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropImageUrlAddFile1To3AndReadMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->string('file1')->nullable()->after('message_detail');
            $table->string('file2')->nullable()->after('file1');
            $table->string('file3')->nullable()->after('file2');
            $table->unsignedTinyInteger('is_read')->default(0)->after('file3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('message_detail');
            $table->dropColumn('file1');
            $table->dropColumn('file2');
            $table->dropColumn('file3');
            $table->dropColumn('is_read');
        });
    }
}
