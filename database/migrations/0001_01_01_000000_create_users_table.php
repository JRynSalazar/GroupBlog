<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('users', function (Blueprint $table) {
                $table->id('user_id');
                $table->string('name');
                $table->integer('age');
                $table->string('email')->unique();
                $table->string('password');
                $table->enum('user_type', ['admin', 'user']);
                $table->timestamp('email_verified_at')->nullable(); 
                $table->rememberToken();
                $table->text('bio')->nullable();  // Nullable bio field
                $table->string('profile_image')->nullable()->default('images/default-profile.png'); // Nullable profile image with default
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
