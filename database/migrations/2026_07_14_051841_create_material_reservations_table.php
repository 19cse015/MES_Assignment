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
        Schema::create('material_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('material_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('reserved_quantity',12,2);

            $table->string('status',30);

            $table->timestamp('reserved_at');

            $table->timestamps();

            $table->unique([
                'production_order_id',
                'material_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_reservations');
    }
};
