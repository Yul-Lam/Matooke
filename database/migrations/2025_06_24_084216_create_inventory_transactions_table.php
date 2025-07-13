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
            $table->foreignId('harvest_batch_id')->nullable()->constrained();
    $table->foreignId('from_location_id')->nullable()->constrained('inventory_locations');
    $table->foreignId('to_location_id')->nullable()->constrained('inventory_locations');
    $table->decimal('quantity_kg', 10, 2);
    $table->string('transaction_type'); // intake, transfer, roasting, waste, sale
    $table->text('notes')->nullable();
            $table->timestamps();
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
