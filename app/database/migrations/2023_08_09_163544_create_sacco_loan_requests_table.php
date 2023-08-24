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
        Schema::create('sacco_loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('amountrequesting');
            $table->string('paymentperiod');
            $table->string('LoanAppNumber')->default('LAN000')->unique();
            $table->string('LoanStatus')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_loan_requests');
    }
};
