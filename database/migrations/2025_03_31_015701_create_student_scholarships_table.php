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
        Schema::create('student_scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            $table->string('scholarship_name');
            $table->enum('scholarship_type', ['Full', 'Partial', 'Grant', 'Other']);
            $table->decimal('amount', 10, 2)->nullable()->default(0.00);

            $table->enum('status', ['Active', 'Inactive', 'Revoked', 'Completed'])->default('Active');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_scholarships');
    }
};
