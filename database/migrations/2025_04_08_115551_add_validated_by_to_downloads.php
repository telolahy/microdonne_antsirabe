<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidatedByToDownloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('validated_by')->nullable()->after('user_id');
            $table->foreign('validated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->dropColumn('validated_by'); 
        });
    }
}
