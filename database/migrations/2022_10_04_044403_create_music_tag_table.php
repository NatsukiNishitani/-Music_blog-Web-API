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
        Schema::create('music_tag', function (Blueprint $table) {
            $table->foreignId('music_id')->constrained('musics');   //参照先のテーブル名を
            $table->foreignId('tag_id')->constrained('tags');    //constrainedに記載
            $table->primary(['music_id', 'tag_id']);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_tag');
    }
};
