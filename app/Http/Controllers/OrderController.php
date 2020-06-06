<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request['name'];
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // DB::table('orders')->firstOrCreate(
            //     ['order_number' => 'Oakland', 'user_id' => Auth::user()->id, 'status' => 'Pending'],
            //     ['name' => $request['name'], 'phone' => $request['phone'], 'address' => $request['address']]
            // );
            $latestOrder = Order::orderBy('created_at','DESC')->first();

            $order = new Order;
            if ($latestOrder) {
                $order->order_number = '#LA'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
                $order_number = '#LA'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT); 
            } else {
                $order->order_number = '#LA'.str_pad(1, 8, "0", STR_PAD_LEFT);
                $order_number = '#LA'.str_pad(1, 8, "0", STR_PAD_LEFT);
            }
            // $order_number = $order->order_number;
            $order->user_id = Auth::user()->id;
            $order->status = "Pending";
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->save();

            // $ordered = App\Cart::where('order_id', '=', $order->order_number)
            //             ->where('product_id', '=', $product->id)
            //             ->first();

            $cart = new Cart;
            $cart->order_id = $order_number;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->save();

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return view('orders.index',compact('order'))

                        ->with('success','Order created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
