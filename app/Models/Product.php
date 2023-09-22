<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description', 'brand_id'];
    
    /**
     * Product belongs to single brand.
     */
    function brand() : Relation {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Product can have many images.
     */
    function images() : Relation {
        return $this->hasMany(Image::class);
    }
}
