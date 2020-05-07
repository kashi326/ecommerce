<?php

namespace App\Http\Controllers;

use App\itemImagePath;
use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function buy($id){
      $item = Items::where('id','=',$id)->with([
        'user' => function($query){ $query->select('id','name','email');}
        ])->first();
      $item->file_location = itemImagePath::where('item_id','=',$id)->get();
      return view('buy')->with('item',$item);
    }

    public function addtocart(Request $request){
      $data = (object)[];
      $data->itemid = $request->input('itemID');
      $data->quantity = $request->input('quantity');
      $data->userid = $request->input('userID');
      $data->itemDetail = Items::where('id','=',$data->itemid)->with([
      'user' => function($query){ $query->select('id','name');}])->first();
      if(session()->has('itemincart')){
        foreach(session()->get('itemincart') as $value){
          if($value->itemid == $data->itemid && $value->quantity == $data->quantity){
            return response()->json(['message' => 'Item is already in cart','status' => 'failed']);
          }
          
          if($value->itemid == $data->itemid && $value->quantity != $data->quantity){
            $value->quantity = $data->quantity;
            return response()->json(['message' => 'Item quantity updated successfully','status' => 'passed','count'=> count(session()->get('itemincart'))]);
          }
          
        }
        session()->push('itemincart',$data);
      }else{
        session()->push('itemincart',$data);
      }

      return response()->json(['message'=>'Item added in cart successfully','status' => 'passed','count'=> count(session()->get('itemincart'))]);
    }

    public function userProducts(){
      $items = Items::where('user_id',Auth::user()->id)->get();
      return view('seller/products/product')->with('products',$items);
    }

    public function addProduct(Request $request){
      $request->validate([
        'title' => 'required',
        'description' => 'required',
        'instruction' => 'required',
        'price' => 'required|integer|min:1',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'detailimages.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      ]);
      $thumbnail_path = '';
      if($request->hasFile('thumbnail')){
        $image = $request->file('thumbnail');
        $name = $image->getClientOriginalName();
        $image->move(public_path().'/thumbnails/',$name);
        $thumbnail_path = 'thumbnails/'.$name;
      }
      $item = Items::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'specification' => $request->input('Specification'),
        'instruction' => $request->input('instruction'),
        'category' => '',
        'thumbnail' => $thumbnail_path,
        'price' => $request->input('price'),
        'user_id' => Auth::user()->id
      ]);
      $item->save();

      $data = [];
      if($request->hasFile('detailimages')){
        foreach($request->file('detailimages') as $image){
          $name = $image->getClientOriginalName();
          $image->move(public_path().'/images/',$name);
          $imagePath =itemImagePath::create([
            'file_location' => 'images/'.$name,
            'item_id' => $item->id
          ]);
          $imagePath->save();
        }
      }
      dump($data);
    }
}