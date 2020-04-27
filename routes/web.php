<?php

use Illuminate\Support\Facades\Route;
use App\Items;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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

Auth::routes(['verify' => true]);
//main routes
Route::get('/', function () {
  $items = Items::paginate(25);
    return view('home')->with('items',$items);
});

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


//seller modules routes
Route::prefix('seller')->group(function(){
  
  Route::get('dashboard',function(){
    return view('seller/dashboard');
   })->name('sellerdashboard');

  Route::get('products','itemsController@userProducts')->name('product');
  Route::prefix('product')->group(function(){

    Route::get('new',function(){
      return view('seller/products/addproduct');
    })->name('addproduct');
    
    Route::post('add','itemsController@addProduct')->name('product');
  });
  
  Route::get('profile',function(){

  })->name('sellerprofile');
  
  Route::post('profile',function(){

  })->name('sellerprofile');


  Route::get('edititem/{id}',function($id){
    echo "hello";
  })->name('edititem');
  
  Route::get('remove/{id}',function($id){
    Items::where('id',$id)->delete();
    $items = [];
    $items = Items::where('user_id',Auth::user()->id)->get();
    return view('seller/products/product')->with('products',$items);
  })->name('removeitem');  
});

//Admin Modules routes
