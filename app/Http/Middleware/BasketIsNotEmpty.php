<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = session('orderId');
        if (!is_null($orderId) && Order::getFullSum() > 0) {
                return $next($request);
        }
        session()->flash('warning', 'Ваша корзина пуста, добавьте товар');
        return redirect()->route('index');
    }
}
