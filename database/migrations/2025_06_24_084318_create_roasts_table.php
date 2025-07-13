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
        Schema::create('roasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harvest_batch_id')->constrained();
    $table->date('roast_date');
    $table->string('roast_level'); // light, medium, dark
    $table->decimal('input_quantity_kg', 10, 2);
    $table->decimal('output_quantity_kg', 10, 2); // accounting for moisture loss
    $table->decimal('shrinkage_percentage', 5, 2);
    $table->text('flavor_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roasts');
    }
};
