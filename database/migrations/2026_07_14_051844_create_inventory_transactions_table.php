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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
          $table->foreignId('production_order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('material_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('transaction_type',30);

            $table->decimal('quantity',12,2);

            $table->text('remarks')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('created_at')->useCurrent();

            $table->index('transaction_type');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
