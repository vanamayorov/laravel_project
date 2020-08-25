<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function products(){
      return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
  }

  public function calculatePrice(){
    $sum = 0;
    foreach($this->products as $product){
      $sum += $product->getPriceForCount();
    }
    return $sum;
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
