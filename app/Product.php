<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'image', 'title', 'description', 'price'
    ];


    public function scopeSearch($query,$params) {

        return $query->where('title', 'LIKE', '%' . $params . '%');

    }

    /**
     * @return mixed
     */
    public function scopeGetProducts()
    {
        return Product::orderBy('id', 'desc');
    }
}
