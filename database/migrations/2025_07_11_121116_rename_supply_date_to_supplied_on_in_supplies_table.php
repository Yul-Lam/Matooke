<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSupplyDateToSuppliedOnInSuppliesTable extends Migration
{
    public function up()
    {
        Schema::table('supplies', function (Blueprint $table) {
            $table->renameColumn('supply_date', 'supplied_on');
        });
    }

    public function down()
    {
        Schema::table('supplies', function (Blueprint $table) {
            $table->renameColumn('supplied_on', 'supply_date');
        });
    }
}
