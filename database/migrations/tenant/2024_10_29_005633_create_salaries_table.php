<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->bigInteger('gross_salary');
            $table->bigInteger('net_salary');
            $table->unsignedBigInteger('tax_amount');
            $table->unsignedBigInteger('salary_rate');
            $table->unsignedBigInteger('total_days_worked');
            $table->unsignedBigInteger('total_minutes_late');
            $table->date('cut_off_start');
            $table->date('cut_off_end');
            $table->date('date_generated');
            $table->json('benefits')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
