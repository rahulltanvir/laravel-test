<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
        }
    </style>

</head>

<body>

<div class="header">
    <h2>Invoice</h2>
    <h4>Order ID: #{{ $order->id }}</h4>
</div>


<h3>Customer Information</h3>

<table>
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
        <td>{{ $order->email }}</td>
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
        <th>Payment Method</th>
        <td>{{ $order->payment_method }}</td>
    </tr>
</table>


<h3>Product Information</h3>

<table>

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
            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->product->name }}
            </td>

            <td>
                {{ $item->quantity }}
            </td>

            <td>
                {{ $item->price }}
            </td>

            <td>
                {{ $item->price * $item->quantity }}
            </td>
        </tr>

    @endforeach

    </tbody>

</table>


<div class="total">

    <p>
        Subtotal:
        {{ $order->subtotal }}
    </p>

    <p>
        Tax:
        {{ $order->tax }}
    </p>

    <p>
        Shipping:
        {{ $order->shipping_cost }}
    </p>

    <h3>
        Grand Total:
        {{ $order->grand_total }}
    </h3>

</div>


</body>
</html>