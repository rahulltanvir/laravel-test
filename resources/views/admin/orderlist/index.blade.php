@extends('admin.master')

@section('body')

<div class="card">
    <div class="card-header">
        <h4>Manage Orders</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($orders as $order)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->grand_total }}</td>

                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        @else
                            <span class="badge bg-success">
                                Confirmed
                            </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.order.details', $order->id) }}"
                           class="btn btn-primary btn-sm">
                            Details
                        </a>

                        @if($order->status == 'pending')
                            <a href="{{ route('admin.order.confirm', $order->id) }}"
                               class="btn btn-success btn-sm">
                                Confirm
                            </a>
                        @else
                            <a href="{{ route('admin.invoice', $order->id) }}"
                               class="btn btn-info btn-sm">
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