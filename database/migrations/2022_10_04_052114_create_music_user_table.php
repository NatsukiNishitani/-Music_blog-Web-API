<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_user', function (Blueprint $table) {
            $table->foreignId('music_id')->constrained('musics');   //参照先のテーブル名を
            $table->foreignId('user_id')->constrained('users');    //constrainedに記載
            $table->primary(['music_id', 'user_id']);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_user');
    }
};
