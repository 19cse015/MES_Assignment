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
        Schema::create('production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number',100)->unique();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bom_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('quantity');

            $table->string('status',30);

            $table->text('remarks')->nullable();

            $table->timestamp('planned_at')->nullable();

            $table->timestamp('released_at')->nullable();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamp('closed_at')->nullable();

            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_orders');
    }
};
