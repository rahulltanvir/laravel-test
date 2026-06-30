@extends('admin.master')

@section('body')

<div class="card">

    <div class="card-header">
        <h4>Manage Orders</h4>
    </div>


    <div class="card-body">


        <table class="table table-bordered table-responsive">

            <thead>

                <tr>

                    <th>SL</th>

                    <th>Order ID</th>

                    <th>Name</th>

                    <th>Phone</th>

                    <th>Total</th>

                    <th>Payment</th>

                    <th>Payment Status</th>

                    <th>Order Status</th>

                    <th>Action</th>

                </tr>

            </thead>



            <tbody>


            @foreach($orders as $order)


                <tr>


                    <td>
                        {{ $loop->iteration }}
                    </td>


                    <td>
                        #{{ $order->id }}
                    </td>


                    <td>
                        {{ $order->name }}
                    </td>


                    <td>
                        {{ $order->phone }}
                    </td>


                    <td>
                        {{ number_format($order->grand_total) }}৳
                    </td>



                    <!-- Payment Info -->

                    <td>

                        {{ ucfirst($order->payment_method) }}


                        @if($order->transaction_id)

                            <br>

                            <small>
                                Trx:
                                {{ $order->transaction_id }}
                            </small>

                        @endif



                        @if($order->sender_number)

                            <br>

                            <small>
                                Number:
                                {{ $order->sender_number }}
                            </small>

                        @endif


                    </td>



                    <!-- Payment Status -->

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



                    <!-- Order Status -->

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




                    <!-- Action -->

                    <td>


                        <a href="{{ route('admin.order.details',$order->id) }}"
                           class="btn btn-primary btn-sm mb-1">

                            Details

                        </a>




                        {{-- Payment Approve --}}

                        @if(
                            $order->payment_method != 'cod'
                            &&
                            $order->payment_status == 'Pending'
                        )


                        <a href="{{ route('admin.payment.approve',$order->id) }}"
                           class="btn btn-success btn-sm mb-1">

                            Approve Payment

                        </a>


                        @endif





                        {{-- Confirm Order --}}

                        @if($order->status == 'pending')


                        <a href="{{ route('admin.order.confirm',$order->id) }}"
                           class="btn btn-info btn-sm mb-1">

                            Confirm

                        </a>


                        @endif





                        {{-- Cancel Order --}}


                        @if($order->status != 'cancelled')


                        <a href="{{ route('admin.order.cancel',$order->id) }}"
                           class="btn btn-danger btn-sm mb-1"
                           onclick="return confirm('Are you sure cancel this order?')">

                            Cancel

                        </a>


                        @endif





                        {{-- Invoice --}}


                        @if($order->status == 'confirmed')


                        <a href="{{ route('admin.invoice',$order->id) }}"
                           class="btn btn-dark btn-sm mb-1">

                            Invoice

                        </a>


                        @endif



                    </td>



                </tr>


            @endforeach



            </tbody>


        </table>


    </div>


</div>


@endsection