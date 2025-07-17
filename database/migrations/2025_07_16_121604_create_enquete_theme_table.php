<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnqueteThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquete_theme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquete_id');
            $table->unsignedBigInteger('theme_id');
            $table->timestamps();
            $table->foreign('enquete_id')->references('id')->on('enquetes')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->unique(['enquete_id', 'theme_id']); // empêche les doublons
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquete_theme');
    }
}
