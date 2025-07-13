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
        Schema::create('harvest_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained();
    $table->foreignId('coffee_grade_id')->constrained();
    $table->date('harvest_date');
    $table->decimal('quantity_kg', 10, 2);
    $table->string('processing_method'); // Washed, Natural, Honey, etc.
    $table->string('quality_notes')->nullable();
    $table->string('status')->default('in_storage'); // in_storage, in_transit, processed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvest_batches');
    }
};
