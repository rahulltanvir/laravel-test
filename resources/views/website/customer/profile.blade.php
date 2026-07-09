@extends('website.master')

@section('body')

<div class="container py-5">

    <div class="card">

        <div class="card-header">
            <h4>My Profile</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('customer.profile.update') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Name</label>

                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        value="{{ old('name', $customer->name) }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>

                    <input
                        type="email"
                        class="form-control"
                        value="{{ $customer->email }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label>Phone</label>

                    <input
                        type="text"
                        class="form-control"
                        name="phone"
                        value="{{ old('phone', $customer->phone) }}">
                </div>

                <div class="mb-3">
                    <label>Address</label>

                    <textarea
                        class="form-control"
                        name="address"
                        rows="3">{{ old('address', $customer->address) }}</textarea>
                </div>

                <button class="btn btn-primary">
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</div>

@endsection