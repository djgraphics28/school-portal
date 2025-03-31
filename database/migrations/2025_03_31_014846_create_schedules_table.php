<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');

            $table->string('sched_code')->unique();
            $table->string('class_name');
            $table->unsignedBigInteger('instructor')->nullable();
            $table->integer('max_students')->default(0);

            // Example JSON format:
            // [
            //   {
            //     "start_time": "08:00",
            //     "end_time": "09:30",
            //     "days": ["Monday", "Wednesday", "Friday"]
            //   },
            //   {
            //     "start_time": "13:00",
            //     "end_time": "14:30",
            //     "days": ["Tuesday", "Thursday"]
            //   }
            // ]
            $table->json('schedule_time_days')->nullable(); // Contains array of schedule details with start_time, end_time and days
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
