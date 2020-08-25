<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About project

Online store examination project created on Laravel 7.0.
The initial idea was taken from YouTube, where I have picked a lot of information from videos and then implemented it on my project.

1. Basically, I have an index page, where each of products is shown.
   A user can add a product to a cart or go to a product-page, where all neccessary info about it is written.
2. Next, there is a categories page, where all categories are shown.
   Right there a user can open a category he is interested in.
3. On exact category page all products of this category are displayed.
   It is made using Many-to-One relationship(1 category may have many products, while 1 product can only have 1 category).
4. Cart page uses cart_not_empty middleware in order to filter http requests and redirect user back if some requirements are not satisfied.
   The requirements are the following:
    1) If the number of products = 0, return back. 
    2) If the order session hasn't been created yet, return back. 
    Right before a realization of cart functionality, tables `orders` and `order_product` should be created. 
    Since we have a Many-to-Many relationship, when each order may have many products, and simultaneously each product may be in many orders, we should define a new method in OrderController which will use`order_product_table`. 
    
    1) Adding a product to a cart: The whole process of adding/removing is based on using session. 
    If session is null, a program must create a new record in`orders_table`and put new record`s id into session.
    Then through recently created method in OrderController it can attach our product to order->products.
    It also checks whether a product is already in the cart, if so, count++.
    If session exists, the program only needs to attach our product to order->products. 
    
    2) The same with removing products from a cart, except attach method. I use detach() instead. 
    
    3) Cart place page
    There are 2 fields which should be filled to confirm an order. In Order model using method orderConfirm the program gets the info from fields and insert it to `orders_table`.
    Then, it destroys our session.

5. Auth
   Using laravel auth package we can access neccessary auth functionality without creating it by our own. Some neccessary controllers, a middleware, and views can be accessable just from box.
   I create a method isAdmin() in User model to define if the user is admin or not.
   In Login Controller in the redirectTo() method I check the user's status and then return relevant routes. Admin has an opportunity to create, edit, delete both categories and products. Both of categories and products controllers are made using REST. Resource controllers are ones with already created methods(such as index, create, store, show, edit, update, destroy), which allow us save time and connect them to needed Model. I`ve also created Requests to validate information form form fields. They are used in some methods in Resource Controllers.
   I used Storage facade to store images on my PC and make them visible in my project. To do so, I made a symlink at first to keep them in public/storage.
   Last but not least, I created some Blade Custom Directives to check if a user is admin and add class active on my menu.

Thanks for having read up to these sentence. I hope my description helped you better understand logic of my project and acquire some knowledge :)
