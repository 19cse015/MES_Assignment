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
        Schema::create('production_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('machine_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('workstation_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('operator_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('status', 30);

            $table->timestamp('assigned_at');

            $table->timestamp('released_at')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index(['machine_id', 'released_at']);
            $table->index(['workstation_id', 'released_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_assignments');
    }
};
