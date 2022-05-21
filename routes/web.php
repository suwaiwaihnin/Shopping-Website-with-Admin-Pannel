<?php
use Illuminate\Support\Facades\Route;

//Admin
Route::get('/admin/login', 'Admin\AuthController@showLogin');
Route::post('/admin/login', 'Admin\AuthController@authenticate');

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => 'Admin'],function(){
    Route::get('/dashboard','AuthController@dashboard');
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::get('/order/pending','ProductController@pendingOrder');
    Route::get('/order/success','ProductController@successOrder');
    Route::get('/order/success/{id}','ProductController@makeSuccess');
});


//User Auth
Route::get('/login','User\AuthController@showLogin');
Route::post('/login','User\AuthController@postLogin');

Route::get('/register','User\AuthController@showRegister');
Route::post('/register','User\AuthController@postRegister');

Route::get('/logout','User\AuthController@logout');

//User Route
Route::get('/','User\PageController@index');
Route::get('/product/{slug}','User\PageController@productDetail');
Route::get('/product/category/{slug}','User\PageController@productByCategory');
Route::get('/product/search/{search}','User\PageController@searchProduct');

//User Auth Route
Route::group(['middleware' => 'AuthUser'],function(){
    Route::get('/add/cart/{id}','User\PageController@addToCart');
    Route::get('/cart','User\PageController@viewCart');
    Route::get('/checkout','User\PageController@viewCheckout');
    Route::post('/checkout','User\PageController@Checkout');
    Route::get('/order/pending','User\OrderController@pending');
    Route::get('/order/complete','User\OrderController@complete');
    Route::get('/user/update','User\PageController@update');
    Route::post('/user/update','User\PageController@updateProfile');
});


