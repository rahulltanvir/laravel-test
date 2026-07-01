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
                <td>{{ $order->email ?? '-' }}</td>
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
                <th>Note</th>
                <td>
                    {{ $order->note ?? '-' }}
                </td>
            </tr>



            {{-- Payment Method --}}

            <tr>
                <th>Payment Method</th>
                <td>
                    {{ ucfirst($order->payment_method) }}
                </td>
            </tr>



            {{-- Payment Status --}}

            <tr>
                <th>Payment Status</th>

                <td>

                    @if($order->payment_status == 'Paid')

                        <span class="badge bg-success">
                            Paid
                        </span>

                    @else

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                    @endif

                </td>

            </tr>




            {{-- Sender Number --}}

            @if($order->sender_number)

            <tr>

                <th>
                    Sender Number
                </th>


                <td>
                    {{ $order->sender_number }}
                </td>

            </tr>

            @endif




            {{-- Transaction ID --}}

            @if($order->transaction_id)

            <tr>

                <th>
                    Transaction ID
                </th>


                <td>
                    {{ $order->transaction_id }}
                </td>

            </tr>

            @endif





            {{-- Order Status --}}

            <tr>

                <th>
                    Order Status
                </th>


                <td>


                    @if($order->status == 'pending')


                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>


                    @elseif($order->status == 'confirmed')


                        <span class="badge bg-success">
                            Confirmed
                        </span>


                    @elseif($order->status == 'cancelled')


                        <span class="badge bg-danger">
                            Cancelled
                        </span>


                    @endif


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

                        {{ $item->product_name }}

                    </td>



                    <td>

                        {{ $item->quantity }}

                    </td>



                    <td>

                        {{ number_format($item->price) }}৳

                    </td>



                    <td>

                        {{ number_format($item->price * $item->quantity) }}৳

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

                <th>
                    Subtotal
                </th>


                <td>
                    {{ number_format($order->subtotal) }}৳
                </td>


            </tr>



            <tr>

                <th>
                    VAT
                </th>


                <td>
                    {{ number_format($order->tax) }}৳
                </td>


            </tr>




            <tr>

                <th>
                    Shipping Cost
                </th>


                <td>
                    {{ number_format($order->shipping_cost) }}৳
                </td>


            </tr>




            <tr>

                <th>
                    Grand Total
                </th>


                <td>

                    <strong>
                        {{ number_format($order->grand_total) }}৳
                    </strong>

                </td>


            </tr>


        </table>




        {{-- Action Buttons --}}


        <div class="mt-4">


            @if(
                $order->payment_method != 'cod'
                &&
                $order->payment_status == 'Pending'
            )


            <a href="{{ route('admin.payment.approve',$order->id) }}"
               class="btn btn-success">

                Approve Payment

            </a>


            @endif





            @if($order->status == 'pending')


            <a href="{{ route('admin.order.confirm',$order->id) }}"
               class="btn btn-primary">

                Confirm Order

            </a>


            @endif





            @if($order->status != 'cancelled')


            <a href="{{ route('admin.order.cancel',$order->id) }}"
               class="btn btn-danger"
               onclick="return confirm('Cancel this order?')">

                Cancel Order

            </a>


            @endif



            @if($order->status == 'confirmed')


            <a href="{{ route('admin.invoice',$order->id) }}"
               class="btn btn-dark">

                Invoice

            </a>


            @endif



        </div>



    </div>

</div>


@endsection