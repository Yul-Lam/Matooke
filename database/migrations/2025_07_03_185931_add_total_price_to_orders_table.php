
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->after('status')->nullable();
        });
    }
    public function down(): void
    {
       if (Schema::hasColumn('orders', 'total_price')){
        Schema::table('orders', function (Blueprint $table){
            $table->dropColumn('total_price');
        });
       }
    }
   

};
   
