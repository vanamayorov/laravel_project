@extends('master')
@section('title', 'Оформление заказа')
@section('content')
<h1>Подтвердите заказ:</h1>
<div class="container">
   <div class="row justify-content-center">
      <p>Общая стоимость: <b>{{$order->calculatePrice()}} ₽.</b></p>
      <form action="{{route('cartConfirm')}}" method="POST">
         <div>
            <p>Укажите свои имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>
            <div class="container">
               @error('name')
               <div class="alert alert-danger">{{$message}}</div>
               @enderror
               <div class="form-group">
                 
                  <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                  
                  <div class="col-lg-4">
                     
                     <input type="text" name="name" id="name" value="" class="form-control">
                  </div>
               </div>
               <br>
               <br>
               @error('phone')
                     <div class="alert alert-danger">{{$message}}</div>
               @enderror
               <div class="form-group">
                  
                  <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер телефона: </label>
                  
                  <div class="col-lg-4">
                     <input type="text" name="phone" id="phone" value="" class="form-control">
                  </div>
               </div>
               <br>
               <br>
            </div>
            <br>
            @csrf
            <input type="submit" class="btn btn-success" value="Подтвердите заказ">
         </div>
      </form>
   </div>
</div>
@endsection