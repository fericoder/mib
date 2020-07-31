<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'ShopController@index')->name('shop.index');
Route::get('/category/{id}', 'ShopController@category')->name('shop.category');
Route::get('/product/{id}', 'ShopController@product')->name('shop.product');
Route::get('/product/{id}', 'ShopController@product')->name('shop.product');
Route::get('/brand/{id}', 'ShopController@brand')->name('shop.brand');
Route::get('/search/{category?}/{keyword?}/', 'ShopController@search')->name('shop.search');


// Profile
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/addressesShow', 'ProfileController@addressesShow')->name('profile.addressesShow');
Route::post('/profile/addressesStore', 'ProfileController@addressesStore')->name('profile.addressesStore');
Route::get('/profile/informationShow', 'ProfileController@informationShow')->name('profile.informationShow');
Route::post('/profile/informationUpdate', 'ProfileController@informationUpdate')->name('profile.informationUpdate');
Route::get('/profile/orders', 'ProfileController@orders')->name('profile.orders');
Route::get('/profile/passwordShow', 'ProfileController@passwordShow')->name('profile.passwordShow');
Route::post('/profile/passwordUpdate', 'ProfileController@passwordStore')->name('profile.passwordUpdate');



// Cart
Route::get('/{shop}/user-cart', 'CartController@show')->name('user-cart')->where(['shop' => '[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+){0,2}']);
Route::post('/{shop}/user-cart/{userID}/add', 'CartController@addToCart')->name('user-cart.add')->where(['shop' => '[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+){0,2}', 'userID' => '[0-9]+']);
Route::post('/{shop}/user-cart/remove', 'CartController@removeFromCart')->name('user-cart.remove')->where(['shop' => '[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+){0,2}']);





Route::prefix('dashboard')->middleware('auth')->group(function () {

    Route::get('index', 'DashboardController@index')->name('dashboard.index');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('features', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::resource('comments', 'CommentController');
    Route::get('specifications-assignment/{specificationItem}', 'specificationItemAssignmentController@edit')->name('specification-item-assignment.edit');
    Route::put('specifications-assignment/{specificationItem}/update', 'specificationItemAssignmentController@update')->name('specification-item-assignment.update');
    Route::resource('specifications', 'SpecificationController');
    Route::resource('SpecificationItems', 'SpecificationItemController');
    Route::resource('users', 'UserController');



    // Comment Actions
    Route::get('comment/notApproved', 'CommentController@notApproved')->name('comment.notApproved');
    Route::post('comment/delete', 'CommentController@destroy');
    Route::post('comment/restore', 'CommentController@restore');
    Route::get('comment/approve/{id}/{commentable}', 'CommentController@approve')->name('comment.approve')->where(['id' => '[0-9]+']);

    //users
    Route::resource('users', 'UserController');
    Route::get('users/purchase/{userID}/show/{id}', 'UserController@purcheseShow')->name('users.purchase.show')->where(['userID' => '[0-9]+', 'id' => '[0-9]+']);
    Route::get('users/purchases/{user}', 'UserController@purchases')->name('users.purchases')->where(['id' => '[0-9]+']);
    Route::post('users/delete', 'UserController@destroy')->name('user.delete');


    //SpecificationItem
    Route::resource('specification-item', 'SpecificationItemController');
    Route::get('specification-item/main/{id}', 'SpecificationItemController@main')->name('specification-item.main')->where(['id' => '[0-9]+']);
    Route::put('specification-item/main/change-status/{id}', 'SpecificationItemController@changeStatus')->name('specification-item.change-status');
    Route::post('specification-item/main/delete', 'SpecificationItemController@destroy')->name('specification-item.delete');
    Route::post('specification-item/main/restore', 'SpecificationItemController@restore');
    Route::post('product-list/getSpecificationItems', 'ProductController@getSpecificationItems')->name('product-list.getSpecificationItems');

    //Purchases
    Route::resource('purchases', 'PurchaseController');
    Route::post('purchases/{purchaseID}/delete/{id}', 'PurchaseController@destroy')->name('purchases.delete')->where(['purchaseID' => '[0-9]+', 'id' => '[0-9]+']);
    Route::post('purchases/{purchaseID}/restore/{id}', 'PurchaseController@restore')->name('purchases.restore')->where(['purchaseID' => '[0-9]+', 'id' => '[0-9]+']);
    Route::put('purchases/change-status/{id}', 'PurchaseController@changeStatus')->name('purchases.change-status')->where(['id' => '[0-9]+']);



    // Delets
    Route::post('products/delete', 'ProductController@destroy');
    Route::post('categories/delete', 'CategoryController@destroy');
    Route::post('brands/delete', 'BrandController@destroy');
    Route::post('specifications/delete', 'SpecificationController@destroy');
    Route::post('SpecificationItems/delete', 'SpecificationItemController@destroy');

});



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Auth::routes();
