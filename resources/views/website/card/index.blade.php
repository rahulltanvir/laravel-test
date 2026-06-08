@extends('website.master')

@section('title')
    Shopping Cart page
@endsection

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <h1 class="page-title">Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart section">
        <div class="container">

            <div class="cart-list-head">

                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">Product Name</div>
                        <div class="col-lg-2">Quantity</div>
                        <div class="col-lg-2">Subtotal</div>
                        <div class="col-lg-2">Discount</div>
                        <div class="col-lg-1">Remove</div>
                    </div>
                </div>

                @php
                    $cartItems = session('cart', []);
                    $total = 0;
                @endphp

                @forelse ($cartItems as $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="cart-single-list">
                        <div class="row align-items-center">

                            <div class="col-lg-1">
                                <img src="{{ asset($item['image']) }}" width="60">
                            </div>

                            <div class="col-lg-4">
                                <h5>{{ $item['name'] }}</h5>
                            </div>

                            <div class="col-lg-2">
                                <p>{{ $item['quantity'] }}</p>
                            </div>

                            <div class="col-lg-2">
                                <p>{{ number_format($subtotal) }}৳</p>
                            </div>

                            <div class="col-lg-2">
                                <p>0৳</p>
                            </div>

                            <div class="col-lg-1">
                                <a href="#"><i class="lni lni-close"></i></a>
                            </div>

                        </div>
                    </div>

                @empty

                    <div class="text-center py-5">
                        <h4>Your Cart is Empty</h4>
                    </div>
                @endforelse

            </div>

            {{-- TOTAL SECTION --}}
            <div class="row">
                <div class="col-12">

                    <div class="total-amount">
                        <div class="row">

                            <div class="col-lg-8"></div>

                            <div class="col-lg-4">
                                <div class="right">

                                    <ul>
                                        <li>Cart Subtotal<span>{{ number_format($total) }}৳</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>0৳</span></li>
                                        <li class="last">You Pay<span>{{ number_format($total) }}৳</span></li>
                                    </ul>

                                    <div class="button">
                                        <a href="{{ route('check-out') }}" class="btn">Checkout</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
