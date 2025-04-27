<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ShowCarController;

Route::get('/', function () {

    $productUrl = route('product.view',['lang' => 'en', 'id' => 1234]);
    dd($productUrl);

    return view('welcome');
});

Route::view('/about', 'about',['phone' => '+55 31 983114021'])->name('about');

Route::get('{lang}/product/{id}/review/{reviewId}', function(string $lang, string $id, string $reviewId){
    
    return "Product id=$id";
});

Route::get('/product/{id}', function(string $id){

    return "Product id=$id";

})->whereNumber('id');

Route::get('/user/{username}', function(string $username){

    return "Username=$username";

})->where('username','[a-z]+');

Route::get('{lang}/product/{id}', function(string $lang, string $id){
    
    return "Product id=$id and lang=$lang";
})->name('product.view')
->where(['lang'=>'[a-z]{2}', 'id' => '\d{4,}']);

Route::get('/search/{search}', function(string $search){
    return $search;
})
->where('search', '.+')
;

Route::get('/user/profile', function(){})->name('profile');

Route::get('/current-user', function(){
    return to_route('profile');
});

Route::prefix('admin')->group(function(){
    Route::get('/user/{username}', function(string $username){

        return "Username=$username";
    
    })->where('username','[a-z]+');
});

// Route::fallback(function(){
//     return to_route('about');
// });

Route::get('/soma/{num1}/{num2}', function(float $num1, float $num2){

    return ($num1 + $num2);

})->whereNumber(['num1','num2']);



Route::controller(CarController::class)->group(function(){
    Route::get('/car', 'index');
    Route::get('/my-car', 'list-my-cars');
});

Route::get('/car/invokable',CarController::class);


Route::resource('/product',ProductController::class)
->except('destroy'); 