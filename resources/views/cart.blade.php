@extends('master')
@section('title', 'Корзина')
@section('content')
<h1>Корзина</h1>
<p>Оформление заказа</p>
<div class="panel">
   <table class="table table-striped">
      <thead>
         <tr>
            <th>Название</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Стоимость</th>
         </tr>
      </thead>
      <tbody>
         @if ($order == null)
             <p>You have no products in your cart!</p>
         @endif
         @forelse($order->products as $product)
         <tr>
            <td>
               <a href="{{route('product', [$product->category->code, $product->code]) }}">
               <img height="56px" src="{{Storage::url($product->image)}}">
               {{$product->name}}
               </a>
            </td>
            <td>
               <span class="badge">{{$product->pivot->count}}</span>
               <div class="btn-group form-inline">
                  <form action="{{route('productRemove', $product)}}" method="POST">
                     <button type="submit" class="btn btn-danger">
                        <span
                        class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                    @csrf                        
                  </form>
                  <form action="{{route('productAdd', $product)}}" method="POST">
                     <button type="submit" class="btn btn-success"
                        href=""><span
                        class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                        @csrf                        
                  </form>
               </div>
            </td>
            <td>{{$product->price}} ₽</td>
            <td>{{$product->getPriceForCount()}} ₽</td>
         </tr>
         @empty
         <p>You have no products in your cart!</p>
         @endforelse
         <tr>
            <td colspan="3">Общая стоимость:</td>
            <td>{{$order->getFullSum()}} ₽</td>
         </tr>
      </tbody>
      
   </table>
   <br>
   <div class="btn-group pull-right" role="group">
      <a type="button" class="btn btn-success" href="{{route('cartPlace')}}">Оформить заказ</a>
   </div>
</div>
@endsection