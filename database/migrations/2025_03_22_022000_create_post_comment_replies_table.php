<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('post_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->text('comment');
            $table->timestamps();

            $table->foreign('post_id')->references('post_id')->on('post_comment')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comment_replies');
    }
};
