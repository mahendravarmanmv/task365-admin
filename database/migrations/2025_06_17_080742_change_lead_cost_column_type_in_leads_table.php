<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLeadCostColumnTypeInLeadsTable extends Migration
{
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Change from decimal(10,2) to integer
            $table->integer('lead_cost')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Revert back to decimal(10,2)
            $table->decimal('lead_cost', 10, 2)->nullable()->change();
        });
    }
}

