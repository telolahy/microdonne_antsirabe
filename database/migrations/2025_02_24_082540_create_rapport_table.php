<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path'); // Chemin du fichier
            $table->unsignedBigInteger('download_id'); // Clé étrangère sans `foreignId()`
            $table->timestamps();

            // Ajout de la contrainte de clé étrangère
            $table->foreign('download_id')->references('id')->on('downloads')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapports');
    }
}
