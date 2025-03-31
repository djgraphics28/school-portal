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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();

            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('birth_date');
            $table->string('contact_number');
            $table->string('email')->unique();

            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->date('date_hired')->nullable();

            $table->text('permanent_address')->nullable();
            $table->text('current_address')->nullable();

            $table->decimal('salary', 10, 2)->nullable();

            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
