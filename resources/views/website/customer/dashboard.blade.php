@extends('website.master')

@section('body')

<section class="account-login section">
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <div class="list-group">

                    <a href="{{ route('customer.dashboard') }}"
                        class="list-group-item list-group-item-action active">
                        Dashboard
                    </a>

                    <a href="#"
                        class="list-group-item list-group-item-action">
                        My Orders
                    </a>

                    <a href="#"
                        class="list-group-item list-group-item-action">
                        Profile
                    </a>

                    <form action="{{ route('customer.logout') }}" method="POST">
                        @csrf

                        <button class="list-group-item list-group-item-action text-danger w-100 text-start border-0">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

            <div class="col-lg-9">

                <div class="card">

                    <div class="card-body">

                        <h3>
                            Welcome,
                            {{ auth('customer')->user()->name }}
                        </h3>

                        <hr>

                        <p>
                            From your dashboard you can view your recent orders,
                            manage your profile and update your password.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection