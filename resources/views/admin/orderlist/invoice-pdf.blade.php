<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
<style>
 *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#333;
    margin:25px;
    line-height:1.5;
}

/*==============================
    HEADER
==============================*/

.header{
    background:#18233d;
    color:#fff;
    padding:15px 20px;
    margin-bottom:20px;
}

.header table{
    width:100%;
    border-collapse:collapse;
    border:none;
}

.header td{
    border:none;
    vertical-align:middle;
}

.company{
    text-align:right;
}

.company h2{
    font-size:24px;
    margin-bottom:5px;
}

.company p{
    margin:2px 0;
    font-size:12px;
}

/*==============================
    TITLE
==============================*/

.title{
    text-align:center;
    margin:15px 0 25px;
}

.title h1{
    font-size:30px;
    letter-spacing:2px;
}

.title p{
    color:#666;
}

/*==============================
    LEFT & RIGHT INFO
==============================*/

.invoice-info{
    width:100%;
    border:none;
    border-collapse:collapse;
    table-layout:fixed;
    margin-bottom:20px;
}

.invoice-info td{
    border:none;
    vertical-align:top;
}

.left-box{
    width:50%;
    text-align:left;
}

.right-box{
    width:50%;
    text-align:right;
}

.left-box table{
    width:auto;
    border:none;
    border-collapse:collapse;
}

.right-box table{
    width:auto;
    border:none;
    border-collapse:collapse;
    margin-left:auto;
}

.left-box td,
.right-box td{
    border:none;
    padding:3px 0;
    font-size:12px;
}

.label{
    width:120px;
    font-weight:bold;
    white-space:nowrap;
}

/*==============================
    SECTION TITLE
==============================*/

.info-title{
    background:#18233d;
    color:#fff;
    padding:8px 10px;
    font-weight:bold;
    margin:15px 0 10px;
}

/*==============================
    PRODUCT TABLE
==============================*/

.product-table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

.product-table th{
    background:#18233d;
    color:#fff;
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}

.product-table td{
    border:1px solid #ccc;
    padding:8px;
}

.product-table td:nth-child(1),
.product-table td:nth-child(3),
.product-table td:nth-child(4),
.product-table td:nth-child(5){
    text-align:center;
}

.product-table td:nth-child(2){
    text-align:left;
}

.product-table tbody tr:nth-child(even){
    background:#f8f8f8;
}

/*==============================
    TOTAL BOX
==============================*/

.total-box{
    width:300px;
    margin-top:20px;
    margin-left:auto;
}

.total-box table{
    width:100%;
    border-collapse:collapse;
}

.total-box th,
.total-box td{
    border:1px solid #ccc;
    padding:8px;
}

.total-box th{
    background:#f5f5f5;
    text-align:left;
}

.total-box td{
    text-align:right;
}

.grand th,
.grand td{
    background:#18233d;
    color:#fff;
    font-size:14px;
    font-weight:bold;
}

/*==============================
    SIGNATURE
==============================*/

.signature{
    margin-top:80px;
}

.signature table{
    width:100%;
    border:none;
}

.signature td{
    width:33.33%;
    border:none;
    text-align:center;
}

.line{
    width:150px;
    margin:0 auto 5px;
    border-top:1px solid #000;
}

/*==============================
    FOOTER
==============================*/

.footer {
    position: fixed;
    bottom: 10px;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 11px;
    color: #555;
}
</style>
  

</head>

<body>

    <!-- Header -->

    <div class="header">

        <table>

            <tr>

                <td>

                    <img src="{{ public_path('uploads/invoice-logo/wahziamain.png') }}" width="140">

                </td>
<div class="info-title" style="font-size: 30px;">Wahzia Tecnology</div>
                <td class="company">

                    

                    <p>Rajshahi, Bangladesh</p>

                    <p>Phone : 01XXXXXXXXXX</p>

                    <p>Email : info@mycommerce.com</p>

                </td>

            </tr>

        </table>

    </div>

    <!-- Title -->

    <div class="title">

       <div class="">
       <h3> INVOICE</h3>
    </div>

    </div>

    <!-- Customer -->

   <table class="invoice-info">

    <tr>

        <!-- LEFT SIDE -->

        <td class="left-box">

            <table>

                <tr>
                    <td class="label">Customer Name</td>
                    <td>: {{ $order->name }}</td>
                </tr>

                <tr>
                    <td class="label">Contact No.</td>
                    <td>: {{ $order->phone }}</td>
                </tr>

                <tr>
                    <td class="label">Email</td>
                    <td>: {{ $order->email }}</td>
                </tr>

                <tr>
                    <td class="label">Address</td>
                    <td>:
                        {{ $order->division }},
                        {{ $order->district }},
                        {{ $order->upazila }},
                        {{ $order->address }}
                    </td>
                </tr>

               

            </table>

        </td>

        <!-- RIGHT SIDE -->

        <td class="right-box">

            <table>

                <tr>
                    <td class="label">Invoice No.</td>
                    <td>: INV-WHT-{{ $order->created_at->format('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                </tr>

                <tr>
                    <td class="label">Date</td>
                    <td>: {{ $order->created_at->format('d-M-Y h:i A') }}</td>
                </tr>

                <tr>
                    <td class="label">Status</td>
                    <td>: {{ ucfirst($order->status ?? 'Pending') }}</td>
                </tr>

                <tr>
                    <td class="label">Billed By</td>
                    <td>: Admin</td>
                </tr>

                <tr>
                    <td class="label">Order ID</td>
                    <td>: #{{ $order->id }}</td>
                </tr>
                 <tr>
                    <td class="label">Payment</td>
                    <td>: {{ $order->payment_method }}</td>
                </tr>

            </table>

        </td>

    </tr>

</table>

<div style="clear:both;"></div>

    <!-- Product -->

    

    <table class="product-table">

        <thead>

            <tr>

                <th width="7%">SL</th>

                <th>Product Name</th>

                <th width="10%">Qty</th>

                <th width="18%">Unit Price</th>

                <th width="18%">Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach($order->items as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->product->name ?? 'Product Deleted' }}</td>

                    <td>{{ $item->quantity }}</td>

                    <td> {{ number_format($item->price,2) }}</td>

                    <td> {{ number_format($item->price * $item->quantity,2) }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <!-- Total -->

    <div class="total-box">

        <table>

            <tr>

                <th>Subtotal</th>

                <td> {{ number_format($order->subtotal,2) }}</td>

            </tr>

            <tr>

                <th>Tax</th>

                <td> {{ number_format($order->tax,2) }}</td>

            </tr>

            <tr>

                <th>Shipping</th>

                <td> {{ number_format($order->shipping_cost,2) }}</td>

            </tr>

            <tr class="grand">

                <th>Grand Total</th>

                <td> {{ number_format($order->grand_total,2) }}</td>

            </tr>

        </table>

    </div>

    <div style="clear:both"></div>

    <!-- Signature -->

    <div class="signature">

        <table>

            <tr>

                <td>

                    <div class="line"></div>

                    Received By

                </td>

                <td>

                    <div class="line"></div>

                    Checked By

                </td>

                <td>

                    <div class="line"></div>

                    Authorized By

                </td>

            </tr>

        </table>

    </div>

    <!-- Footer -->

    <div class="footer" >

        <p>Thank you for shopping with us.</p>

        <p>Generated On : {{ now()->format('d M Y h:i A') }}</p>

        <p>This is a computer generated invoice.</p>

    </div>

</body>

</html>