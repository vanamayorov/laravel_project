@extends('master')
@section('title', 'Категория')
@section('content')
<h1>
    {{$category->name}} | Количество товаров: {{$category->products->count()}}  
 </h1>
 <p>
    {{$category->description}}
 </p>
 <div class="row">
    @foreach ($category->products as $product)
        @include('card',['product' => $product])
    @endforeach
 </div>
 @endsection