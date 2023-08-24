<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('sacco_issues', function (Blueprint $table) {
            $table->id();
            $table->string('MemberNumber');
            $table->integer('phoneNumber');
            $table->date('DateofRequest');
             $table->string('ReferenceNumber', 4)->default('R000')->unique(); // Default value set
            $table->timestamps();
        });


       // Add trigger to generate reference numbers
        DB::unprepared('
            CREATE TRIGGER tr_generate_reference_number BEFORE INSERT ON sacco_issues
            FOR EACH ROW
            BEGIN
                DECLARE new_number INT;
                SET new_number = IFNULL((SELECT MAX(CAST(SUBSTRING(ReferenceNumber, 2) AS UNSIGNED)) + 1 FROM sacco_issues), 1);
                SET NEW.ReferenceNumber = CONCAT("R", LPAD(new_number, 3, "0"));
            END;
        ');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_issues');
    }
};
