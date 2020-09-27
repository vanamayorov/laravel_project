<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        //dd(Route::currentRouteNamed('person.orders.index'));
        $orders = Auth::user()->orders()->active()->paginate(6);
        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order){
       if(!Auth::user()->orders->contains($order)){
            return redirect()->route('person.orders.index');
        }
        return view('auth.orders.show', compact('order'));
    }
}
