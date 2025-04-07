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
        $table->string('location')->nullable()->after('lead_notes');
        $table->string('business_name')->nullable()->after('location');
        $table->string('industry')->nullable()->after('business_name');
        $table->string('website_type')->nullable()->after('industry');
        $table->text('features_needed')->nullable()->after('website_type');
        $table->string('reference_website')->nullable()->after('features_needed');
        $table->integer('budget_min')->nullable()->after('reference_website');
        $table->integer('budget_max')->nullable()->after('budget_min');
        $table->string('service_timeframe')->nullable()->after('budget_max');
    });
}

public function down()
{
    Schema::table('leads', function (Blueprint $table) {
        $table->dropColumn([
            'location',
            'business_name',
            'industry',
            'website_type',
            'features_needed',
            'reference_website',
            'budget_min',
            'budget_max',
            'service_timeframe',
        ]);
    });
}

};
