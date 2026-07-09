@extends('website.master')

@section('body')

<section class="account-login section">
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h4>My Orders</h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $key => $order)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>#{{ $order->id }}</td>
                            <td>৳ {{ number_format($order->grand_total,2) }}</td>
                            <td>{{ strtoupper($order->payment_method) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
    <a href="{{ route('customer.order.details', $order->id) }}"
       class="btn btn-sm btn-primary">
        View Details
    </a>
</td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No Orders Found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</section>

@endsection