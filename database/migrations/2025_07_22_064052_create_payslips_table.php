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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('base_salary', 10, 2);
            $table->decimal('ot_1_5_hours', 8, 2)->default(0);
            $table->decimal('ot_2_0_hours', 8, 2)->default(0);
            $table->decimal('ot_1_5_pay', 10, 2)->default(0);
            $table->decimal('ot_2_0_pay', 10, 2)->default(0);
            $table->decimal('deduction', 10, 2)->default(0);
            $table->decimal('total_salary', 10, 2);
            $table->timestamps();
            // Prevent duplicate payslips
            $table->unique(['employee_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
