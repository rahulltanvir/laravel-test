@extends('website.master')

@section('title')
Checkout Page
@endsection

@section('body')

<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h1 class="page-title">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">

            <!-- LEFT SIDE: FORM -->
            <div class="col-lg-8">

                <form action="{{ route('check-out-store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <div class="card p-3 mb-3">
                                <h5>Customer Information</h5>

                                <div class="mb-3">
                                    <label>Full Name *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Info -->
                        <div class="col-md-6">
                            <div class="card p-3 mb-3">
                                <h5>Shipping Address</h5>

                                <div class="mb-3">
                                    <label>Division *</label>
                                    <select name="division" class="form-control" required>
                                        <option value="">Select</option>
                                        <option>Dhaka</option>
                                        <option>Rajshahi</option>
                                        <option>Khulna</option>
                                        <option>Chattogram</option>
                                        <option>Barishal</option>
                                        <option>Sylhet</option>
                                        <option>Rangpur</option>
                                        <option>Mymensingh</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>District *</label>
                                    <input type="text" name="district" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Upazila *</label>
                                    <input type="text" name="upazila" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Address *</label>
                                    <textarea name="address" class="form-control" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Payment -->
                        <!-- Payment -->
<div class="col-md-12">
    <div class="card p-4 mb-3">

        <h5 class="mb-3">Payment Method</h5>

        <!-- Cash On Delivery -->
        <div class="form-check mb-2">
            <input class="form-check-input payment-method"
                   type="radio"
                   name="payment_method"
                   id="cod"
                   value="cod"
                   checked>

            <label class="form-check-label" for="cod">
                Cash On Delivery
            </label>
        </div>

        <!-- bKash -->
        <div class="form-check mb-2">
            <input class="form-check-input payment-method"
                   type="radio"
                   name="payment_method"
                   id="bkash"
                   value="bkash">

            <label class="form-check-label" for="bkash">
                bKash
            </label>
        </div>

        <!-- Nagad -->
        <div class="form-check mb-2">
            <input class="form-check-input payment-method"
                   type="radio"
                   name="payment_method"
                   id="nagad"
                   value="nagad">

            <label class="form-check-label" for="nagad">
                Nagad
            </label>
        </div>

        <!-- Rocket -->
        <div class="form-check mb-2">
            <input class="form-check-input payment-method"
                   type="radio"
                   name="payment_method"
                   id="rocket"
                   value="rocket">

            <label class="form-check-label" for="rocket">
                Rocket
            </label>
        </div>

        <!-- Bank -->
        <div class="form-check mb-3">
            <input class="form-check-input payment-method"
                   type="radio"
                   name="payment_method"
                   id="bank"
                   value="bank">

            <label class="form-check-label" for="bank">
                Bank Transfer
            </label>
        </div>

        <!-- Payment Info -->
        <div id="payment-box"
             class="border rounded p-3 bg-light"
             style="display:none;">

            <h6 class="mb-3">
                Payment Information
            </h6>

            <div class="alert alert-warning">

                <strong>bKash Personal:</strong> 017XXXXXXXX <br>

                <strong>Nagad Personal:</strong> 018XXXXXXXX <br>

                <strong>Rocket:</strong> 019XXXXXXXX <br>

                <strong>Bank Account:</strong><br>

                DBBL<br>

                A/C Name : Your Company<br>

                A/C No : 1234567890

            </div>

            <div class="mb-3">
                <label>Sender Mobile Number</label>

                <input type="text"
                       name="sender_number"
                       class="form-control"
                       placeholder="01XXXXXXXXX">
            </div>

            <div class="mb-3">
                <label>Transaction ID</label>

                <input type="text"
                       name="transaction_id"
                       class="form-control"
                       placeholder="Transaction ID">
            </div>

        </div>

        <button class="btn btn-primary mt-3 w-100">
            Place Order
        </button>

    </div>
</div>

                    </div>
                </form>

            </div>

            <!-- RIGHT SIDE: SUMMARY -->
            <div class="col-lg-4">

                <div class="checkout-sidebar">

                    <div class="checkout-sidebar-price-table">

                        <h5>Pricing Table</h5>

                        <div>
                            <p>Cart Total: {{ number_format($cartTotal) }}৳</p>
                            <p>VAT: {{ number_format($tax) }}৳</p>
                            <p>Shipping: {{ number_format($shippingCost) }}৳</p>
                        </div>

                        <hr>

                        <h4>
                            Grand Total: {{ number_format($grandTotal) }}৳
                        </h4>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

@endsection
<script>

document.addEventListener('DOMContentLoaded',function(){

    const methods=document.querySelectorAll('.payment-method');

    const box=document.getElementById('payment-box');

    methods.forEach(function(item){

        item.addEventListener('change',function(){

            if(this.value=="cod")
            {
                box.style.display="none";
            }
            else
            {
                box.style.display="block";
            }

        });

    });

});

</script>