@extends('website.master')

@section('body')
    <section class="account-login section py-5">
        <div class="container">

            <div class="row">

                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">

                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">

                            <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Customer">

                            <h5 class="mb-1">
                                {{ auth('customer')->user()->name }}
                            </h5>

                            <small class="text-muted">
                                {{ auth('customer')->user()->email }}
                            </small>

                        </div>

                        <div class="list-group list-group-flush">

                            <a href="{{ route('customer.dashboard') }}"
                                class="list-group-item list-group-item-action active">
                                <i class="lni lni-dashboard me-2"></i>
                                Dashboard
                            </a>

                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="lni lni-package me-2"></i>
                                My Orders
                            </a>

                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="lni lni-user me-2"></i>
                                My Profile
                            </a>

                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="lni lni-lock-alt me-2"></i>
                                Change Password
                            </a>

                            <form action="{{ route('customer.logout') }}" method="POST">
                                @csrf

                                <button
                                    class="list-group-item list-group-item-action text-danger border-0 w-100 text-start bg-white">
                                    <i class="lni lni-exit me-2"></i>
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

                <!-- Content -->
                <div class="col-lg-9">

                    <!-- Welcome -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">

                            <h3 class="mb-3">
                                Welcome,
                                <span class="text-primary">
                                    {{ auth('customer')->user()->name }}
                                </span>
                            </h3>

                            <p class="text-muted mb-0">
                                Welcome to your customer dashboard.
                                Here you can manage your orders, profile,
                                password and account information.
                            </p>

                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="card shadow-sm border-0 text-center">

                                <div class="card-body">

                                    <i class="lni lni-package fs-1 text-primary"></i>

                                    <h2 class="mt-3 mb-1">
                                        {{ $totalOrders }}
                                    </h2>

                                    <p class="text-muted mb-0">
                                        Total Orders
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="card shadow-sm border-0 text-center">

                                <div class="card-body">

                                    <i class="lni lni-timer fs-1 text-warning"></i>

                                    <h2 class="mt-3 mb-1">
                                        {{$pendingOrders}}
                                    </h2>

                                    <p class="text-muted mb-0">
                                        Pending Orders
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="card shadow-sm border-0 text-center">

                                <div class="card-body">

                                    <i class="lni lni-checkmark-circle fs-1 text-success"></i>

                                    <h2 class="mt-3 mb-1">
                                        {{ $completedOrders }}
                                    </h2>

                                    <p class="text-muted mb-0">
                                        Completed Orders
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Recent Orders -->
                    <div class="card shadow-sm border-0 mt-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">
                                Recent Orders
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-hover align-middle">

    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse($orders as $key => $order)

        <tr>

            <td>{{ $key + 1 }}</td>

            <td>
                <strong>#{{ $order->id }}</strong>
            </td>

            <td>
                {{ $order->created_at->format('d M Y') }}
            </td>

            <td>
                ৳{{ number_format($order->grand_total,2) }}
            </td>

            <td>

                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>

                @elseif($order->status == 'confirmed')
                    <span class="badge bg-primary">
                        Confirmed
                    </span>

                @elseif($order->status == 'processing')
                    <span class="badge bg-info">
                        Processing
                    </span>

                @elseif($order->status == 'shipped')
                    <span class="badge bg-secondary">
                        Shipped
                    </span>

                @elseif($order->status == 'delivered')
                    <span class="badge bg-success">
                        Delivered
                    </span>

                @elseif($order->status == 'cancelled')
                    <span class="badge bg-danger">
                        Cancelled
                    </span>

                @else
                    <span class="badge bg-dark">
                        {{ ucfirst($order->status) }}
                    </span>
                @endif

            </td>

            <td>

  <a href="{{ route('customer.invoice',$order->id) }}"
   target="_blank"
   class="btn btn-sm btn-danger">

    <i class="lni lni-download"></i>
    PDF Invoice

</a>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="6" class="text-center py-4">
                No Orders Found
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
