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
	Schema::table('leads', function (Blueprint $table) {
		$table->string('lead_file')->nullable()->after('lead_notes');
	});
	}

	public function down()
	{
	Schema::table('leads', function (Blueprint $table) {
		$table->dropColumn('lead_file');
	});
	}

};
