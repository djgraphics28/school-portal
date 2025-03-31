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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');

            $table->decimal('prelim', 5, 2)->nullable()->default(0.00);
            $table->decimal('midterm', 5, 2)->nullable()->default(0.00);
            $table->decimal('prefinal', 5, 2)->nullable()->default(0.00);
            $table->decimal('finals', 5, 2)->nullable()->default(0.00);

            $table->decimal('final_grade', 5, 2)->nullable()->default(0.00);
            $table->string('remarks')->nullable();  // e.g., "Passed", "Failed", "Incomplete"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
