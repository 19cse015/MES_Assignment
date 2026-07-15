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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();

            $table->string('name', 150);

            $table->unsignedInteger('capacity');

            $table->string('operating_status', 30);

            $table->string('maintenance_status', 30);

            $table->timestamps();

            $table->index('operating_status');
            $table->index('maintenance_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
