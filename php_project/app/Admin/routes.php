<?php

use Illuminate\Routing\Router;


Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('merchant_cat',MerchantCatController::class);
    $router->resource('merchant_list',MerchantController::class);
    $router->resource('user_list',UserController::class);
    $router->resource('merchant/commodity',CommodityController::class);
    $router->resource('article/cat',ArticleCatController::class);
    $router->resource('article/list',ArticleController::class);
    $router->resource('comment/list',CommentController::class);

});

