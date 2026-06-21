@extends('website.master')

@section('title')
    Check out Page
@endsection

@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="#">Shop</a></li>
                        <li>checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('check-out') }}" method="POST">
                        @csrf

                        <div class="row">

                            <!-- Customer Information -->
                            <div class="col-md-6">
                                <div class="card p-3 mb-3">
                                    <h5>Customer Information</h5>

                                    <div class="mb-3">
                                        <label>Full Name *</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Phone Number *</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Email (Optional)</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Information -->
                            <div class="col-md-6">
                                <div class="card p-3 mb-3">
                                    <h5>Shipping Address</h5>

                                    <div class="mb-3">
                                        <label>Division *</label>
                                        <select name="division" class="form-control" required>
                                            <option value="">Select Division</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Rajshahi">Rajshahi</option>
                                            <option value="Khulna">Khulna</option>
                                            <option value="Chattogram">Chattogram</option>
                                            <option value="Barishal">Barishal</option>
                                            <option value="Sylhet">Sylhet</option>
                                            <option value="Rangpur">Rangpur</option>
                                            <option value="Mymensingh">Mymensingh</option>
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
                                        <label>Full Address *</label>
                                        <textarea name="address" rows="3" class="form-control" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label>Order Note</label>
                                        <textarea name="note" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="col-md-12">
                                <div class="card p-3">
                                    <h5>Payment Method</h5>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="cod"
                                            checked>

                                        <label class="form-check-label">
                                            Cash On Delivery
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="bkash">

                                        <label class="form-check-label">
                                            Bkash
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="nagad">

                                        <label class="form-check-label">
                                            Nagad
                                        </label>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            Place Order
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <p>Appy Coupon to get discount!</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="button">
                                        <button class="btn">apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="checkout-sidebar-price-table mt-30">

                            <h5 class="title">
                                Pricing Table
                            </h5>


                            <div class="sub-total-price">


                                <div class="total-price">

                                    <p class="value">
                                        Cart Total:
                                    </p>

                                    <p class="price">
                                        {{ number_format($cartTotal) }}৳
                                    </p>

                                </div>



                                <div class="total-price discount">

                                    <p class="value">
                                        VAT 10%:
                                    </p>

                                    <p class="price">
                                        {{ number_format($tax) }}৳
                                    </p>

                                </div>



                                <div class="total-price shipping">

                                    <p class="value">
                                        Shipping Cost:
                                    </p>

                                    <p class="price">
                                        {{ number_format($shippingCost) }}৳
                                    </p>

                                </div>


                            </div>



                            <div class="total-payable">

                                <div class="payable-price">

                                    <p class="value">
                                        Grand Total:
                                    </p>

                                    <p class="price">
                                        {{ number_format($grandTotal) }}৳
                                    </p>

                                </div>

                            </div>



                            <div class="price-table-btn button">

                                <a href="javascript:void(0)" class="btn btn-alt">
                                    Checkout
                                </a>

                            </div>


                        </div>
                        <div class="checkout-sidebar-banner mt-30">
                            <a href="product-grids.html">
                                <img src="website/assets/images/banner/banner.jpg" alt="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
