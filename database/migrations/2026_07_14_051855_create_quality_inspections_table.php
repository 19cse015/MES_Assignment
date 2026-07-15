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
        Schema::create('quality_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_order_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('inspector_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('status', 30);

            $table->string('result', 30)->nullable();

            $table->unsignedInteger('defect_quantity')->default(0);

            $table->text('remarks')->nullable();

            $table->timestamp('inspected_at');

            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_inspections');
    }
};
