<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name', 
        'slug', 
        'description', 
        'price_general', 
        'price_member', 
        'sizes', 
        'stock', //
        'image_url'
    ];

    protected $casts = [
        'sizes' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}