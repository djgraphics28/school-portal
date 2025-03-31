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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();

            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('birth_date');
            $table->string('contact_number');

            $table->string('email')->unique()->nullable();
            $table->unsignedBigInteger('course');
            $table->unsignedBigInteger('major')->nullable();

            $table->text('permanent_address');
            $table->text('current_address')->nullable();

            // Guardian and Parents Info
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();

            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact_number')->nullable();
            $table->text('guardian_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
