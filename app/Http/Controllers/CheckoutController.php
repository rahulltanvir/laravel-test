<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);

        $cartTotal = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }


        $tax = ($cartTotal * 10) / 100;


        // Category wise shipping
        $categories = [];

        foreach ($cartItems as $item) {
            $product = Product::find($item['id']);

            $categories[$product->category_id] = $product->category->shipping_charge;
        }

        $shippingCost = array_sum($categories);


        $grandTotal = $cartTotal + $tax + $shippingCost;


        return view('website.checkout.index', compact(
            'cartItems',
            'cartTotal',
            'tax',
            'shippingCost',
            'grandTotal'
        ));
    }
}