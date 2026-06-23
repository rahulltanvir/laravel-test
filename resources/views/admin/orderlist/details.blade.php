@extends('admin.master')

@section('body')

<div class="card">

    <div class="card-header">
        <h4>Order Details</h4>
    </div>


    <div class="card-body">


        {{-- Customer Information --}}

        <h5>Customer Information</h5>

        <table class="table table-bordered">

            <tr>
                <th width="200">Order ID</th>
                <td>#{{ $order->id }}</td>
            </tr>


            <tr>
                <th>Name</th>
                <td>{{ $order->name }}</td>
            </tr>


            <tr>
                <th>Phone</th>
                <td>{{ $order->phone }}</td>
            </tr>


            <tr>
                <th>Email</th>
                <td>{{ $order->email }}</td>
            </tr>


            <tr>
                <th>Address</th>
                <td>
                    {{ $order->division }},
                    {{ $order->district }},
                    {{ $order->upazila }},
                    {{ $order->address }}
                </td>
            </tr>


            <tr>
                <th>Payment Method</th>
                <td>
                    {{ $order->payment_method }}
                </td>
            </tr>


            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-warning">
                        {{ $order->status }}
                    </span>
                </td>
            </tr>


        </table>



        {{-- Product Information --}}

        <h5 class="mt-4">
            Order Products
        </h5>


        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>

            </thead>


            <tbody>


                @foreach($order->items as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td>
                        {{ $item->product->name }}
                    </td>


                    <td>
                        {{ $item->quantity }}
                    </td>


                    <td>
                        {{ $item->price }}
                    </td>


                    <td>
                        {{ $item->price * $item->quantity }}
                    </td>


                </tr>


                @endforeach


            </tbody>


        </table>




        {{-- Order Summary --}}

        <h5 class="mt-4">
            Order Summary
        </h5>


        <table class="table table-bordered">


            <tr>
                <th>Subtotal</th>
                <td>{{ $order->subtotal }}</td>
            </tr>


            <tr>
                <th>Tax</th>
                <td>{{ $order->tax }}</td>
            </tr>


            <tr>
                <th>Shipping Cost</th>
                <td>{{ $order->shipping_cost }}</td>
            </tr>


            <tr>
                <th>Grand Total</th>
                <td>
                    <strong>
                        {{ $order->grand_total }}
                    </strong>
                </td>
            </tr>


        </table>



    </div>

</div>


@endsection