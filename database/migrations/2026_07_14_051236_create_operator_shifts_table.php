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
        Schema::create('operator_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('shift_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('work_date');

            $table->timestamps();

            $table->unique(['operator_id', 'work_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_shifts');
    }
};
