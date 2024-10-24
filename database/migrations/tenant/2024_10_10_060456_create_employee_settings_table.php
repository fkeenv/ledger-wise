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
        Schema::create('employee_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('salary')->default(0);
            $table->enum('salary_type', ['daily', 'monthly', 'hourly']);
            $table->integer('tax')->default(0);
            $table->enum('employment_type', ['regular', 'part-time', 'internship', 'contract']);
            $table->dateTime('start_date');
            $table->dateTime('regular_date')->nullable();
            $table->dateTime('resign_date')->nullable();
            $table->boolean('can_overtime')->default(true);
            $table->boolean('is_active')->default(true);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_settings');
    }
};
