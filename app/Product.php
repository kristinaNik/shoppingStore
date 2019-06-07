<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    //

    protected $fillable = [
        'image', 'title', 'description', 'price'
    ];


    public function scopeSearch( Builder $query, $params) {
        return $query->where('title', 'LIKE', "%$params%")->get();
    }
}
