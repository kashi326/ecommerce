<?php

namespace App\Http\Controllers;

use App\itemImagePath;
use App\Items;
use Illuminate\Http\Request;

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
}