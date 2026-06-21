<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{

    // ================= SHIPPING CALCULATION =================
    private function getShippingCost($totalWeight)
    {
        if ($totalWeight <= 1) {
            return 80;
        } elseif ($totalWeight <= 3) {
            return 150;
        } elseif ($totalWeight <= 5) {
            return 250;
        }

        return 400;
    }



    // ================= CHECKOUT PAGE =================
    public function index()
    {

        // Get cart from session
        $cartItems = session('cart', []);


        $cartTotal = 0;
        $totalWeight = 0;



        // Calculate Cart Total & Weight
        foreach ($cartItems as $item) {


            $cartTotal += 
            $item['price'] * $item['quantity'];



            if (isset($item['product_weight'])) {

                $totalWeight += 
                $item['product_weight'] * $item['quantity'];

            }

        }



        // Tax 10%
        $tax = ($cartTotal * 10) / 100;



        // Shipping by weight
        $shippingCost = 
        $this->getShippingCost($totalWeight);



        // Grand Total
        $grandTotal = 
        $cartTotal + $tax + $shippingCost;



        return view('website.checkout.index', compact(

            'cartItems',
            'cartTotal',
            'tax',
            'totalWeight',
            'shippingCost',
            'grandTotal'

        ));

    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'division' => 'required',
        'district' => 'required',
        'upazila' => 'required',
        'address' => 'required',
        'payment_method' => 'required',
    ]);

    $cartItems = session('cart', []);

    if(empty($cartItems))
    {
        return redirect()->back()
            ->with('error','Cart is empty');
    }

    $cartTotal = 0;
    $totalWeight = 0;

    foreach($cartItems as $item)
    {
        $cartTotal += $item['price'] * $item['quantity'];

        $totalWeight +=
            $item['product_weight'] *
            $item['quantity'];
    }

    $tax = ($cartTotal * 10) / 100;

    $shippingCost =
        $this->getShippingCost($totalWeight);

    $grandTotal =
        $cartTotal + $tax + $shippingCost;

    $order = Order::create([

        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,

        'division' => $request->division,
        'district' => $request->district,
        'upazila' => $request->upazila,
        'address' => $request->address,

        'note' => $request->note,

        'payment_method' => $request->payment_method,

        'subtotal' => $cartTotal,
        'tax' => $tax,
        'shipping_cost' => $shippingCost,
        'grand_total' => $grandTotal,
    ]);

    foreach($cartItems as $item)
    {
        OrderItem::create([

            'order_id' => $order->id,

            'product_id' => $item['id'],

            'product_name' => $item['name'],

            'price' => $item['price'],

            'quantity' => $item['quantity'],

            'subtotal' =>
                $item['price'] *
                $item['quantity']
        ]);

        Product::where('id',$item['id'])
            ->decrement('stock',$item['quantity']);
    }

    session()->forget('cart');

    return redirect()
        ->route('sucess')
        ->with('success','Order placed successfully');
}

}