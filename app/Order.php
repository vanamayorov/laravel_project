<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['user_id'];

  public function products(){
      return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
  }

  public function calculatePrice(){
    $sum = 0;
    foreach($this->products()->withTrashed()->get() as $product){
      $sum += $product->getPriceForCount();
    }
    return $sum;
  }

  public static function eraseSum(){
    session()->forget('products_sum');
  }

  public static function calculateFullSum($productPrice){
    $sum = self::getFullSum() + $productPrice;
    session(['products_sum' => $sum]);
  }

  public static function getFullSum(){
    return session('products_sum', 0);
  }

  public function scopeActive($query){
    return $query->where('status', 1);
  }

  public function orderConfirm($name, $phone){
    if($this->status == 0) {
      $this->status = 1;
      $this->name = $name;
      $this->phone = $phone;
      $this->save();
      session()->forget('orderId');
      return true;
    }else {
      return false;
    }
    
  }

}
