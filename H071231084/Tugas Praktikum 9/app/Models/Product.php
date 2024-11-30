<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'price', 'stock'];
    public $timestamps = false;

    public function category()
    {
        // product belong to 1 kategori
        return $this->belongsTo(Category::class);
    }

    public function inventoryLogs()
    {
        // 1 product punya banyak inventory log
        return $this->hasMany(InventoryLog::class);
    }
}
