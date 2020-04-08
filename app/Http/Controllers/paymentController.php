<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class paymentController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'=> 'verified']);
    }

    public function index(){
      $total=0;
      $data = [];
      $user = Auth::user();
      if(session()->has('itemincart')){
        $data = session('itemincart');
        foreach($data as $value){
           $total += ($value->quantity * $value->itemDetail->price); 
        }
      }else{
        return redirect()->back()->withErrors('No item in the cart');
      }
      return view('payment')->with(['total'=> $total,'data'=>$data,'user'=> $user]);
    } 
    public function checkout(Request $request){
      if($request->input('paymentMethod') == 'creditCard'){
        $request->validate([
          'nameOnCard'=> 'required',
          'cardNumber'=> 'required',
          'cvc'=>'required',
          'cardExpMonth ' => 'required|digits:2|between:1,12',
          'cardExpYear' => 'required|digits:4|integer|min:'.date('y') .'|max:2040',
          'customerName' => 'required',
          'customerEmail' => 'required|email',
          'customerContact' => 'required',
          'customerShipmentAddress' => 'required'
      ]);
      return response()->json(['message'=>'i m fine']);
      }else{

      }
    }  
}