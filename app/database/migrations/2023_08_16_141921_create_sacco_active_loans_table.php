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
        Schema::create('sacco_active_loans', function (Blueprint $table) {

            $table->id('UserId');

            
            $table->string('MemberID');
            $table->string('Username');
            $table->double('Amount_to_pay');
            $table->double('Payment_Period');
            $table->double('Cleared_Amount');
            $table->double('Loan_Balance');
            $table->string('status')->default('Active'); // Add the status field with 'Active' as default
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_active_loans');
    }
};
