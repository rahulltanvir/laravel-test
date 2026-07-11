<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Cardcontroller extends Controller
{

    // ================= SHIPPING CALCULATION =================
   private function getShippingCost($totalWeight)
    {
        if ($totalWeight <= 1.5) {
            return 150;
        } elseif ($totalWeight <= 2) {
            return 300;
        } elseif ($totalWeight <= 5) {
            return 500;
        }

        return 1000;
    }


    // ================= ADD TO CART =================
    public function index(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {

            $cart[$id]['quantity'] += $request->product_qty;

        } else {

            $cart[$id] = [
                'id'             => $product->id,
                'name'           => $product->name,
                'price'          => $product->sale_price,
                'image'          => $product->thumbnail,
                'quantity'       => $request->product_qty,
                'product_weight' => $product->product_weight,
            ];
        }


        session()->put('cart', $cart);


        return redirect()->route('cart');
    }



    // ================= SHOW CART =================
    public function show()
    {
        $cartItems = session('cart', []);

        $cartTotal = 0;
        $totalWeight = 0;


        foreach ($cartItems as $item) {

            $cartTotal += $item['price'] * $item['quantity'];

            if(isset($item['product_weight'])) {
                $totalWeight += $item['product_weight'] * $item['quantity'];
            }
        }


        $tax = ($cartTotal * 2) / 100;


        $shippingCost = $this->getShippingCost($totalWeight);


        $grandTotal = $cartTotal + $tax + $shippingCost;



        return view('website.card.index', compact(
            'cartItems',
            'cartTotal',
            'tax',
            'totalWeight',
            'shippingCost',
            'grandTotal'
        ));
    }




    // ================= UPDATE QTY =================
    public function updateQty(Request $request)
    {

        $cart = session()->get('cart', []);


        if (!isset($cart[$request->id])) {

            return response()->json([
                'error' => 'Item not found'
            ],404);
        }



        if ($request->action == 'increase') {

            $cart[$request->id]['quantity']++;

        } 
        elseif ($request->action == 'decrease') {

            if($cart[$request->id]['quantity'] > 1){

                $cart[$request->id]['quantity']--;
            }
        }



        session()->put('cart',$cart);



        $lineTotal = 
        $cart[$request->id]['price'] * 
        $cart[$request->id]['quantity'];



        $cartTotal = 0;
        $totalWeight = 0;



        foreach($cart as $item){

            $cartTotal += 
            $item['price'] * $item['quantity'];


            if(isset($item['product_weight'])){

                $totalWeight += 
                $item['product_weight'] * $item['quantity'];
            }
        }



        $tax = ($cartTotal * 10) / 100;


        $shippingCost = $this->getShippingCost($totalWeight);



        $grandTotal = 
        $cartTotal + $tax + $shippingCost;



        return response()->json([

            'status'       => 'success',
            'quantity'     => $cart[$request->id]['quantity'],
            'lineTotal'    => $lineTotal,
            'cartTotal'    => $cartTotal,
            'tax'          => $tax,
            'totalWeight'  => $totalWeight,
            'shippingCost' => $shippingCost,
            'grandTotal'   => $grandTotal,

        ]);

    }





    // ================= REMOVE ITEM =================
    public function remove(Request $request)
    {

        $id = $request->id;


        $cart = session()->get('cart', []);



        if(isset($cart[$id])){

            unset($cart[$id]);

            session()->put('cart',$cart);
        }



        $cartTotal = 0;
        $totalWeight = 0;



        foreach($cart as $item){


            $cartTotal += 
            $item['price'] * $item['quantity'];



            if(isset($item['product_weight'])){

                $totalWeight += 
                $item['product_weight'] * $item['quantity'];
            }

        }



        if(empty($cart)){


            $cartTotal = 0;
            $tax = 0;
            $shippingCost = 0;
            $grandTotal = 0;
            $totalWeight = 0;


        }else{


            $tax = ($cartTotal * 2) / 100;


            $shippingCost = 
            $this->getShippingCost($totalWeight);



            $grandTotal = 
            $cartTotal + $tax + $shippingCost;

        }




        return response()->json([

            'status'       => 'success',
            'cartTotal'    => $cartTotal,
            'tax'          => $tax,
            'totalWeight'  => $totalWeight,
            'shippingCost' => $shippingCost,
            'grandTotal'   => $grandTotal

        ]);

    }


}