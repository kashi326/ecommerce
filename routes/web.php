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
use App\Items;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
  $items = Items::paginate(25);
    return view('home')->with('items',$items);
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/buy/{id}','ItemsController@buy');
Route::post('add','ItemsController@addtocart');
Route::get('mycart',function(){
  $items = session()->has('itemincart')?session('itemincart'):[];
  return view('mycart')->with('itemincart',$items);
})->name('mycart');
Route::get('payment','paymentController@index')->name('payment');
Route::post('checkout','paymentController@checkout')->name('checkout');
Route::post('removeItem',function(Request $request){
  $itemId = $request->get('id');
  $Items = session()->has('itemincart')?session()->pull('itemincart'):[]; 
  foreach($Items as $value){
    if($value->itemid != $itemId){
      session()->push('itemincart',$value);
    }
  }
  $count = session()->has('itemincart')?count(session('itemincart')):0;
  return response()->json(['data' => session('itemincart'),'count' => $count]);
})->name('removeItem');
