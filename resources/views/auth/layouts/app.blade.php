<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Админка: @yield('title')</title>
      <!-- Scripts -->
      <script src="/js/app.js" defer></script>
      <!-- Fonts -->
      <link rel="icon" href="{{Storage::url('icon/online-store.png')}}">
      <link rel="dns-prefetch" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
      <!-- Styles -->
      <link href="/css/app.css" rel="stylesheet">
      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/css/admin.css" rel="stylesheet">
   </head>
   <body>
      <div id="app">
         <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
               <a class="navbar-brand" href="{{route('index')}}">
               Вернуться на сайт
               </a>
               <div id="navbar" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                     @admin
                     <li><a href="{{route('categories.index')}}">Категории</a></li>
                     <li><a href="{{route('products.index')}}">Товары</a></li>
                     <li><a href="{{route('home')}}">Заказы</a></li>
                     @endadmin
                     
                 </ul>
                  <ul class="nav navbar-nav navbar-right">
                     @guest
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Войти</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Зарегистрироваться</a>
                     </li>
                     @endguest
                     @auth
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('get-logout')}}">Выйти</a>
                     </li>
                     @endauth
                  </ul>
               </div>
            </div>
         </nav>
         <div class="py-4">
            <div class="container">
               <div class="row justify-content-center">
                  @yield('content')
                  
               </div>
            </div>
         </div>
      </div>
   </body>
</html>