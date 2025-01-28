<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'per_unit_price',
        'sku',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
