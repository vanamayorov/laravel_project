<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'category_id', 'description', 'image', 'price'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getPriceForCount(){
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
      return $this->price;
    }
}