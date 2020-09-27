<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Http\Requests\OrderConfirmRequest;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $order = (new Cart())->getOrder();
        return view('cart', compact('order'));
    }

    public function cartConfirm(OrderConfirmRequest $request)
    {
        if ((new Cart())->saveOrder($request->name, $request->phone)) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа в полном обьеме.');
        }
        Order::eraseSum();
        return redirect()->route('index');
    }

    public function cartPlace()
    {
        $basket = new Cart();
        $order = $basket->getOrder();
        if(!$basket->countAvailable()){
            session()->flash('warning', 'Товар не доступен для заказа в полном обьеме.');
            return redirect()->route('basket');
        }
        return view('cart-place', compact('order'));
    }
    public function productAdd(Product $product)
    {
        $result = (new Cart(true))->addProduct($product);
        if($result){
            session()->flash('success', 'Добавлен товар ' . $product->name);
        }else{
            session()->flash('warning', $product->name . ' в большем количестве не доступен для заказа');
        }
        return redirect()->route('cart');
    }
    public function productRemove(Product $product)
    {
        (new Cart())->removeProduct($product);
        session()->flash('warning', 'Вы удалили товар ' . $product->name);
        return redirect()->route('cart');
    }
}
