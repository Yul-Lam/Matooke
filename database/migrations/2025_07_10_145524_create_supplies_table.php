<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


public function up()
{
    Schema::create('supplies', function (Blueprint $table) {
        $table->id();
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->foreignId('coffee_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->date('supply_date');
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
