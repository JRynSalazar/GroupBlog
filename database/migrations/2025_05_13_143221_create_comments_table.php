<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->unsignedBigInteger('post_id'); 
            $table->string('user_name'); 
            $table->text('comment_text'); 
            $table->timestamp('comment_date')->useCurrent(); 

          
            $table->foreign('post_id')->references('post_id')->on('post_comment')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
