<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_unique_id',
        'category_id',
        'lead_name',
        'lead_email',
        'lead_phone',
        'lead_notes',
        'location',
        'business_name',
        'website_type',
        'features_needed',
        'reference_website',
        'budget_min',
        'budget_max',
        'lead_cost',
        'stock',
        'service_timeframe',
        'button_text',
        'lead_file',
    ];    

    /**
     * Get the category that the lead belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all payments associated with this lead.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'lead_id');
    }
	public function websiteType()
	{
	return $this->belongsTo(\App\Models\WebsiteType::class);
	}
}
