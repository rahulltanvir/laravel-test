@extends('website.master')

@section('title')
    Shopping Cart page
@endsection

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <h3 class="page-title">Cart</h3>
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
                        <div class="col-lg-2">Total</div>
                        <div class="col-lg-1">Remove</div>
                    </div>
                </div>

                @php

                    $cartTotal = 0;
                @endphp

                @forelse ($cartItems as $item)
                    @php
                        $lineTotal = $item['price'] * $item['quantity'];
                        $cartTotal += $lineTotal;
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
                                <button class=" decrease" style="border:none; width:32px; height:20px;"
                                    data-id="{{ $item['id'] }}">-</button>

                                <span class="qty-{{ $item['id'] }}">
                                    {{ $item['quantity'] }}
                                </span>

                                <button class=" increase" style="border:none; width:32px; height:20px;"
                                    data-id="{{ $item['id'] }}">+</button>
                            </div>

                            <div class="col-lg-2">
                                <p>{{ number_format($item['price']) }}৳</p>
                            </div>

                            <div class="col-lg-2">
                                <p class="line-total-{{ $item['id'] }}">
                                    {{ number_format($lineTotal) }}৳
                                </p>
                            </div>

                            <div class="col-lg-1">
                                <a style=" background: transparent !important" href="javascript:void(0)" class="remove-item"
                                    data-id="{{ $item['id'] }}">
                                    <i style="font-size: 10px;color: red;" class="lni lni-close"></i>
                                </a>
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
                                        <ul>
                                            <li>
                                                Cart total
                                                <span id="cartTotal">{{ number_format($cartTotal) }}৳</span>
                                            </li>

                                            <li>
                                                Shipping Tax 10%
                                                <span id="tax">{{ number_format(($cartTotal * 10) / 100) }}৳</span>
                                            </li>

                                            <li>
                                                Shipping Cost
                                                <span id="shippingCost">{{$shippingCost}}৳</span>
                                            </li>

                                            <li class="last">
                                                Grand Total
                                                <span id="grandTotal">
                                                   {{ number_format($cartTotal + ($cartTotal * 10) / 100 + $shippingCost) }}৳
                                                </span>
                                            </li>
                                        </ul>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
$(document).on('click', '.increase, .decrease', function() {

    let id = $(this).data('id');

    let action = $(this).hasClass('increase')
        ? 'increase'
        : 'decrease';

    $.ajax({
        url: "{{ route('update-cart-qty') }}",
        type: "POST",
        data: {
            id: id,
            action: action,
            _token: "{{ csrf_token() }}"
        },

        success: function(res) {

            if (res.status === 'success') {

                $('.qty-' + id).text(
                    res.quantity
                );

                $('.line-total-' + id).text(
                    res.lineTotal.toLocaleString() + '৳'
                );

                $('#cartTotal').text(
                    res.cartTotal.toLocaleString() + '৳'
                );

                $('#tax').text(
                    res.tax.toLocaleString() + '৳'
                );

                $('#shippingCost').text(
                    res.shippingCost.toLocaleString() + '৳'
                );

                $('#grandTotal').text(
                    res.grandTotal.toLocaleString() + '৳'
                );

                if (res.cartTotal == 0) {

                    $('.cart-list-head').html(`
                        <div class="text-center py-5">
                            <h4>Your Cart is Empty</h4>
                        </div>
                    `);

                }
            }
        }
    });

});
</script>


<script>
   $(document).on('click', '.remove-item', function() {

    let id = $(this).data('id');
    let row = $(this).closest('.cart-single-list');

    $.ajax({
        url: "{{ route('remove-from-cart') }}",
        type: "POST",
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {

            if (res.status === 'success') {

                row.remove();

                $('#cartTotal').text(
                    res.cartTotal.toLocaleString() + '৳'
                );

                $('#tax').text(
                    res.tax.toLocaleString() + '৳'
                );

                $('#shippingCost').text(
                    res.shippingCost.toLocaleString() + '৳'
                );

                $('#grandTotal').text(
                    res.grandTotal.toLocaleString() + '৳'
                );

                if (res.cartTotal == 0) {

                    $('.cart-list-head').html(`
                        <div class="text-center py-5">
                            <h4>Your Cart is Empty</h4>
                        </div>
                    `);
                }
            }
        }
    });

});
</script>
