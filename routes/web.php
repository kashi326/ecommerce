<?php

use Illuminate\Support\Facades\Route;
use App\Items;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Auth::routes(['verify' => true]);
//main routes
//Home route
Route::get('/', function () {
  $items = Items::paginate(25);
    return view('home')->with('items',$items);
});
//Home route
Route::get('/home', 'HomeController@index')->name('home');

//Buy route
Route::get('/buy/{id}','ItemsController@buy');

//Adding item to cart
Route::post('add','ItemsController@addtocart');
//Get items in cart
Route::get('mycart',function(){
  $items = session()->has('itemincart')?session('itemincart'):[];
  return view('mycart')->with('itemincart',$items);
})->name('mycart');

//Remove Item from cart
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

Route::get('payment','paymentController@index')->name('payment');

Route::post('checkout','paymentController@checkout')->name('checkout');

//redirect for seller home
Route::get('/seller',function(){
  return redirect('/seller/dashboard');
});

//seller modules routes
Route::prefix('seller')->middleware(['auth' => 'verified'])->group(function(){
  //Dashboard
  Route::get('dashboard',function(){
    return view('seller/dashboard');
   })->name('sellerdashboard');

   //Geting user/seller products
  Route::get('products','itemsController@userProducts')->name('product');
  Route::prefix('product')->group(function(){
   // return add product view
    Route::get('new',function(){
      return view('seller/products/addproduct');
    })->name('addproduct');
   //add product to database
    Route::post('add','itemsController@addProduct')->name('newproduct');
  });
  //get user profile
  Route::get('profile',function(){

  })->name('sellerprofile');
  
  //edit user profile
  Route::put('profile',function(){

  })->name('sellerprofile');


  Route::get('edit/{id}',function($id){
    $item = Items::where([
      'id' => $id,
      'user_id' => Auth::user()->id
    ])->get();
    if(count($item) == 0){
      abort(404);
    }
      return view('seller/products/edit')->with('product',$item);
  })->name('edititem');
  
  Route::get('remove/{id}',function($id){
    Items::where([
      'id'=>$id,
      'user_id' => Auth::user()->id
      ])->delete();
    $items = [];
    $items = Items::where('user_id',Auth::user()->id)->get();
    return view('seller/products/product')->with('products',$items);
  })->name('removeitem');  
});

//Admin Modules routes
