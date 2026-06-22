@extends('website.master')

@section('title')
Success
@endsection

@section('body')

<div class="container text-center" style="padding: 100px 0;">
    <h1>🎉 Order Placed Successfully!</h1>
    <p>Thank you for your order.</p>

    <a href="{{ route('home') }}" class="btn btn-primary">
        Back to Home
    </a>
</div>

@endsection