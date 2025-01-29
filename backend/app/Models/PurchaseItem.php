<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class PurchaseItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'purchase_items';

    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'price', 'total'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
