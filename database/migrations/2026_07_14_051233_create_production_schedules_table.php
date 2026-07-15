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
        Schema::create('production_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('planned_start')->nullable();

            $table->timestamp('planned_end')->nullable();

            $table->unsignedInteger('priority')->default(1);

            $table->string('status',30);

            $table->timestamps();

            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_schedules');
    }
};
