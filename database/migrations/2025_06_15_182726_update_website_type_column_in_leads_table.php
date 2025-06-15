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
            // First drop the old column if it was not already unsignedBigInteger
            if (Schema::hasColumn('leads', 'website_type')) {
                $table->dropColumn('website_type');
            }

            // Add the correct foreign key column
            $table->unsignedBigInteger('website_type')->nullable()->after('industry');

            // Add the foreign key constraint
            $table->foreign('website_type')->references('id')->on('website_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            //
        });
    }
};
