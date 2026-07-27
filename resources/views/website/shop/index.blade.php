@extends('website.master')

@section('title')
    Shop
@endsection

@section('content')

<div class="container py-5">

    <h2>All Products</h2>

    <div class="row">

        @foreach($products as $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card">

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $product->name }}
                        </h5>

                        <p>
                            Product ID: {{ $product->id }}
                        </p>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection