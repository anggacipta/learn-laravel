<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function (){
    return "Hello Angga Cipta";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function (){
    return "Not found page";
});

Route::view('/hello', 'hello', ['name' => 'Angga']);

Route::get('/hello-again', function (){
    return view('hello', ['name' => 'Angga']);
});

Route::get('/hello-world', function (){
    return view('hello.helloworld', ['name' => 'Angga']);
});


Route::get('/products/{id}', function ($productId){
   return "Product $productId";
})->name('product.detail');

Route::get('/products/{id}/item/{item}', function ($productId, $itemId){
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($categoryId){
    return "Category : " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404'){
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/angga', function ($name){
    return "Conflict Angga Cipta Pranata";
});

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
});


Route::get('/produk/{id}', function ($id){
   $link = route('product.detail', ['id'=>$id]);
   return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail', ['id'=>$id]);
});

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'helloRequest']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'helloRequest']);
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);
