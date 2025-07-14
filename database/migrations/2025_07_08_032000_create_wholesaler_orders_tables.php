<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wholesaler_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retailer_id')->constrained('users')->onDelete('cascade');
            $table->string('delivery_address');
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('wholesaler_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wholesaler_order_id')->constrained('wholesaler_orders')->onDelete('cascade');
            $table->foreignId('wholesaler_product_id')->constrained('wholesaler_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

   public function down(): void
   {
    Schema::dropIfExists('wholesaler_order_items');
    Schema::dropIfExists('wholesaler_orders');

   }
};
