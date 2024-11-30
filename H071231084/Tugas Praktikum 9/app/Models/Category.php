<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    public function products()
    {
        // kategori bisa punya banyak product
        return $this->hasMany(Product::class);
    }

}
