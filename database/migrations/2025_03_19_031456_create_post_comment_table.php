<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->id('post_id');
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('type_id')->nullable(); 
            $table->string('title'); 
            $table->text('content'); 
            $table->string('author_name'); 
            $table->string('image')->nullable();
            $table->timestamp('created_at')->useCurrent(); 

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('discrimination_type')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comment');
    }
};
