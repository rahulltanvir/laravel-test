@extends('website.master')

@section('title')
    Shop
@endsection

@section('body')

<div class="container py-5">

    <h3>All Products</h3>

    <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">

                        <div class="single-product">
                            <div class="product-image">
                                <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                                <div class="button">
                                    <a href="{{ route('product-detail', $product->id) }}" class="btn"><i
                                            class="lni lni-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="category">{{ $product->category->name }}</span>
                                <h4 class="title">
                                    <a href="{{ route('product-detail', $product->id) }}">{{ $product->name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star"></i></li>
                                    <li><span>4.0 Review(s)</span></li>
                                </ul>
                                <div class="price">
                                    <span>Price:{{ number_format($product->sale_price) }}৳</span>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach


            </div>

</div>

@endsection