<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThemeIdToFileThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('theme_id');   
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->unsignedBigInteger('file_id');   
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_theme', function (Blueprint $table) {
            $table->dropColumn('theme_id');
            $table->dropColumn('file_id');
        });
    }
}
