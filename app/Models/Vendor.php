<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'users'; // Explicitly defining the table name

    protected $fillable = [		
        'name', 'email', 'company_name', 'website', 'phone', 
        'alternative_number', 'business_proof', 'identity_proof', 
        'password', 'user_type', 'email_verified_at', 'approved'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [ // Changed from function to array
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'user_categories', 'user_id', 'category_id');
    }
}
