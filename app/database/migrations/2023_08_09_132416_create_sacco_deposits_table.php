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
        Schema::create('sacco_deposits', function (Blueprint $table) {
            
            $table->id('userId');
            $table->string('Username');
            $table->double('amount');
            $table->date('dateDeposited');
            $table->unsignedBigInteger('receiptNumber')->unique();
            $table->boolean('used')->default(false); // Add the used column

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_deposits');
    }
};
