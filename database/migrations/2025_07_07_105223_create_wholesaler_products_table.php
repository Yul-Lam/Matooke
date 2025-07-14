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
        Schema::create('wholesaler_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('grade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('wholesaler_id'); //not constaint yet
            $table->timestamps();

            $table->foreign('wholesaler_id')->references('id')->on('users')->onDelete('cascade');

            

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesaler_products');
    }
};
