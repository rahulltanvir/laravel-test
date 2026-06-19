<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}