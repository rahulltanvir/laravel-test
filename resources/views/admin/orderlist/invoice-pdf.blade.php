<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color:#333;
        }

        .invoice-header{
            width:100%;
            margin-bottom:20px;
            background:#0f132e;
        }

        .invoice-header table{
            width:100%;
            border:none;
        }

        .invoice-header td{
            border:none;
            vertical-align:top;
        }

        .company-info{
            text-align:right;
        }

        .company-info h2{
            margin:0;
        }

        .title{
            text-align:center;
            margin:20px 0;
        }

        .section-title{
            background:#f2f2f2;
            padding:8px;
            font-weight:bold;
            margin-top:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        table, th, td{
            border:1px solid #000;
        }

        th{
            background:#f2f2f2;
        }

        th, td{
            padding:8px;
        }

        .totals{
            margin-top:20px;
            width:40%;
            float:right;
        }

        .totals table{
            width:100%;
        }

        .grand-total{
            font-size:16px;
            font-weight:bold;
        }

        .footer{
            margin-top:80px;
            text-align:center;
            font-size:12px;
            color:#666;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="invoice-header">
        <table>
            <tr>
                <td>
                    <img src="{{ asset('uploads/invoice-logo/wahzia.png') }}"
                         alt=""
                         width="120">
                        
                </td>

                <td class="company-info">
                    <h2>My Commerce</h2>
                    <p>Rajshahi, Bangladesh</p>
                    <p>Phone: 01XXXXXXXXXX</p>
                    <p>Email: info@mycommerce.com</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Invoice Title -->
    <div class="title">
        <h1>INVOICE</h1>
        <h3>Order #{{ $order->id }}</h3>
    </div>

    <!-- Customer Information -->
    <div class="section-title">
        Customer Information
    </div>

    <table>
        <tr>
            <th width="30%">Customer Name</th>
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

    <!-- Product Information -->
    <div class="section-title">
        Product Information
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">SL</th>
                <th>Product Name</th>
                <th width="12%">Qty</th>
                <th width="15%">Price</th>
                <th width="18%">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->product->name ?? 'Product Deleted' }}
                    </td>

                    <td>
                        {{ $item->quantity }}
                    </td>

                    <td>
                        {{ number_format($item->price, 2) }}
                    </td>

                    <td>
                        {{ number_format($item->price * $item->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals">
        <table>
            <tr>
                <th>Subtotal</th>
                <td>৳{{ number_format($order->subtotal, 2) }}</td>
            </tr>

            <tr>
                <th>Tax</th>
                <td>৳{{ number_format($order->tax, 2) }}</td>
            </tr>

            <tr>
                <th>Shipping</th>
                <td>৳{{ number_format($order->shipping_cost, 2) }}</td>
            </tr>

            <tr class="grand-total">
                <th>Grand Total</th>
                <td>৳{{ number_format($order->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear:both;"></div>

    <!-- Footer -->
    <div class="footer">
        <p>Thank you for shopping with us.</p>
        <p>Generated on {{ now()->format('d M Y h:i A') }}</p>
    </div>

</body>
</html>