<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductColor;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable =[
        'user_id',
        'product_id',
        'product_color_id',
        'quantity'
    ];
    /**
    * Get the user that owns the Cart
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product(): BelongsTo
    {
        return $this->belongsTo (Product::class, 'product_id', 'id');
    }
    public function productColor(): BelongsTo
    {
        return $this->belongsTo (ProductColor::class, 'product_color_id', 'id');
    }

}
