<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'product_id'];
    
    /**
     * Image belongs to 1 product.
     */
    function product() : Relation {
        return $this->belongsTo(Product::class);
    }
}
