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
        Schema::create('sacco_members', function (Blueprint $table) {

        $table->id('UserId'); // Primary key (auto-incrementing)
        $table->string('Username', 50);
        $table->string('email', 30);
        $table->string('password', 20);
        $table->integer('phoneNumber')->nullable();
        $table->string('MemberNumber', 9)->unique(); // Unique constraint
        $table->double('accountBalance');
        $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_members');
    }
};
