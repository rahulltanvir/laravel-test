@extends('website.master')

@section('body')

<div class="container py-5">

    <div class="card">

        <div class="card-header">
            <h4>Order #{{ $order->id }}</h4>
        </div>

        <div class="card-body">

            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>

            <hr>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($order->items as $item)

                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>৳ {{ number_format($item->price,2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>৳ {{ number_format($item->subtotal,2) }}</td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="text-end">

                <h5>Subtotal : ৳ {{ number_format($order->subtotal,2) }}</h5>

                <h5>Tax : ৳ {{ number_format($order->tax,2) }}</h5>

                <h5>Shipping : ৳ {{ number_format($order->shipping_cost,2) }}</h5>

                <h4>Total : ৳ {{ number_format($order->grand_total,2) }}</h4>

            </div>

        </div>

    </div>

</div>

@endsection