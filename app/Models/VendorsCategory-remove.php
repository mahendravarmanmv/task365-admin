<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsCategory extends Model
{
    use HasFactory;

    protected $table = 'user_categories'; // Explicitly set the table name
    public $timestamps = false; // Disable timestamps if not needed

    protected $fillable = ['user_id', 'category_id'];

    // Define relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

