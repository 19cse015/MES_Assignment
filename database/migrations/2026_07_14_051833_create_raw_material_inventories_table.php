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
        Schema::create('raw_material_inventories', function (Blueprint $table) {
            $table->id();
           $table->foreignId('material_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('available_quantity', 12, 2)->default(0);

            $table->decimal('reserved_quantity', 12, 2)->default(0);

            $table->timestamps();

            $table->unique('material_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_inventories');
    }
};
