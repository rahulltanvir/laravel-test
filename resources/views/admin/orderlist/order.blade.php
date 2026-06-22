@extends('admin.master')

@section('body')

<div class="container">

    <h3>All Orders</h3>

    <table class="table table-bordered">

        <thead>

        <tr>

            <th>ID</th>
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

            <td>{{ $order->id }}</td>

            <td>{{ $order->name }}</td>

            <td>{{ $order->phone }}</td>

            <td>{{ $order->grand_total }}৳</td>

            <td>{{ $order->status }}</td>

            <td>

                <a href="{{ route('orders.show',$order->id) }}"
                   class="btn btn-primary btn-sm">

                    View

                </a>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection