<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    /**
     * Brand has multiple products.
     */
    function products() : Relation {
        return $this->hasMany(Product::class);
    }
}
