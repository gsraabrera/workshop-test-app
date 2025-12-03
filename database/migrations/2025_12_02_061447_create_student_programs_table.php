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
        Schema::create('student_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // foreign key to students table
            $table->unsignedBigInteger('program_id'); // foreign key to programs table
            $table->string('status')->default('active'); // active, graduated, dropped, etc.
            $table->unsignedBigInteger('term_admitted')->nullable(); // e.g., 1241
            $table->unsignedBigInteger('term_graduated')->nullable(); // e.g., 1251
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade'); 
            $table->foreign('program_id')
                  ->references('id')
                  ->on('programs')
                  ->onDelete('cascade');
            $table->foreign('term_admitted')
                  ->references('id')
                  ->on('terms')
                  ->onDelete('cascade');
            $table->foreign('term_graduated')
                  ->references('id')
                  ->on('terms')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_programs');
    }
};
