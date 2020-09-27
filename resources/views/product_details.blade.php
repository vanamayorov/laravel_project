@extends('master')
@section('title', 'Товар')
@section('content')
            <h1>{{$product->name}}</h1>
            <h2>{{$product->category->name}}</h2>
            <p>Цена: <b>{{$product->price}} ₽</b></p>
            <img src="{{Storage::url($product->image)}}">
            <p>{{$product->description}}</p>
            <form action="{{route('productAdd', $product)}}" method="POST">
               @if ($product->isAvailable())
               <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>   
               @else
               <button class="btn btn-light" disabled>Не доступен</button>
               @endif
               @csrf     
            </form>
@endsection