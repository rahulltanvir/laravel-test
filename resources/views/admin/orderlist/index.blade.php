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
                        <a href="{{ route('admin.order.details', $order->id) }}"
                           class="btn btn-primary btn-sm">
                            Details
                        </a>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

@endsection