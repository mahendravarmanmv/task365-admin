<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_title', 
        'category_description', 
        'category_image'
    ];

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'user_categories', 'category_id', 'user_id');
    }
	public function websiteTypes()
	{
	return $this->hasMany(WebsiteType::class);
	}
}
