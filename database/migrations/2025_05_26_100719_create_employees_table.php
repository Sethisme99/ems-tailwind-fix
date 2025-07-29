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
            $table->string('id_staff')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_id')->unique()->nullable();
            $table->integer('nssf_id')->unique()->nullable();
            $table->string('phone');
            $table->string('place_of_birth');
            $table->string('address');
            $table->date('date_of_birth');
            $table->date('hire_date');
            $table->string('image')->nullable();
            $table->integer('salary');
            $table->boolean('status')->default(1);
            $table->boolean('documents_submitted')->default(1);
            $table->foreignId('department_id')->nullOnDelete();
            $table->foreignId('position_id')->nullOnDelete();
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
