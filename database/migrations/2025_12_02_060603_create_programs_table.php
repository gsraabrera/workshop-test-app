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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('acronym'); // e.g., "CS", "ENG"
            $table->string('name'); // e.g., "Computer Science", "Engineering"      
            $table->text('description')->nullable();
            $table->string('department')->nullable();
            $table->string('status')->default('active'); // e.g., "active", "inactive"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
