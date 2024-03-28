<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.list', ['title' => 'Orders\' List', 'orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->where('user_type', 'user')->get();
        $products = Product::select('id', 'name')->get();

        return view('orders.create', ['title' => 'Create Order!', 'users' => $users, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => intval($request->input('user')),
            'product_total' => array_sum($request->input('product_total'))
        ]);
        
        $order_products = [];
        $i = 0;
        $count = count($request->input('product')); 
        
        //save order product
        foreach($request->input('product') as $key => $value){
            
            $order_products[$i] = [
                'product_id' => $value,
                'order_id' => $order->id,
                'qty' => $request->input('product_qty')[$i]
            ];
            $i++;
        }

        // dd($order_products);
        OrderProduct::insert($order_products);
        //save order

        return redirect()->route('orders.list');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order_id = intval($id);
        $order = Order::find($order_id);
        $order_products = OrderProduct::where('order_id', $order_id)->get();

        return view('orders.view',['order' =>  $order, 'title' => 'View Order', 'products' => $order_products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return 1;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        
    }
}
