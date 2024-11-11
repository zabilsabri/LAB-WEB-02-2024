<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{

    protected $fillable = ['type', 'quantity', 'product_id'];

    public function product()
    {
        // 1 inventory log belongs to 1 produk
        return $this->belongsTo(Product::class);
    }
}
