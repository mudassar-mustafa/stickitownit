<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: fit-content;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #40513b14;
        }

        td,
        th {
            padding: 15px 10px;
            font-size: 14px;
            color: #675d50;
        }

        th {
            cursor: pointer;
        }

        th,
        tbody {
            border-bottom: 3px solid #40513b;
        }
    </style>
</head>
<body>

<p>Dear {{ $order->buyer_detail->name }},</p>

<br>
@if ($order->order_type == 'Sale')
    @if($order->order_status === 'pending')
        <p>Thank you for placing your order with Stickitownit. We are pleased to inform you that your order has been
            successfully received and is being processed. This email serves as an order confirmation and includes the
            details of your purchase.</p>
    @else
        <p>Your order has been {{ $order->order_status }} successfully</p>
    @endif


    <br>
    <p><b>Order Details:</b></p>
    <p>Order Number: {{ 'ST-'.date('Y', strtotime($order->created_at)).'-'.$order->id }}</p>
    <p>Order Date: {{ date('d/m/Y h:i A', strtotime($order->created_at)) }}</p>
    <p>Shipping Address: {{ $order->billing_address }}&nbsp;{{$order->billing_country_detail->name}}
        &nbsp;{{$order->billing_city_detail->name}}</p>
    <p>Phone Number: {{ $order->billing_phone }}</p>

    <table style="width: 600px; text-align:right"> <!-- 600 px width old-->
        <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>

        </tr>
        </thead>
        <tbody>
        @if ($order->order_type == 'Sale')
            @php
                $shippingFee = 0;
                $subTotal = 0;
            @endphp
            @foreach ($orderDetails as $order_detail)
                @php
                    $shippingFee += $order_detail->shipping;
                    $subTotal += $order_detail->price;
                @endphp
                <tr>
                    <td>
                        {{ $order_detail->product_title }}
                        <br>
                        @if ($order_detail->product_type == "variation")
                            <small>{{ $order_detail->product_short_description }}</small>
                        @endif
                    </td>
                    <td>Qty: {{ $order_detail->qty }}</td>
                    <td>${{ $order_detail->price }}</td>

                </tr>
            @endforeach
        @endif
        @if ($order->order_type == 'Sale')
            <tr>
                <td colspan="2" style="border-top:1px solid #ccc;"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc;">Subtotal : ${{$subTotal}}</td>
            </tr>
        @endif
        <tr>
            <td colspan="2"></td>
            <td style="font-size:15px;font-weight:bold;">Shipping :
                ${{ $shippingFee }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="font-size:22px;font-weight:bold;">Total : ${{ $order->order_total_amount }}</td>
        </tr>
        </tbody>
    </table>
@else
    <p>Thank you for subscribing package in Stickitownit. This email serves as an order confirmation and
        includes the details of your purchase.</p>
    <table style="width: 600px; text-align:right"> <!-- 600 px width old-->
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orderDetails as $order_detail)
            <tr>
                <td>{{ $order_detail->package_name }}</td>
                <td>${{ $order->order_total_amount }}</td>

            </tr>
        @endforeach
        <tr>
            <td colspan="1"></td>
            <td style="font-size:22px;font-weight:bold;">Total : ${{ $order->order_total_amount }}</td>
        </tr>
        </tbody>
    </table>
@endif
<br>
<p>We would like to assure you that we are dedicated to providing you with a seamless shopping experience, and we will
    do our best to fulfill your order as quickly as possible.
</p>
<br>
<p>If you have any questions or require further assistance, please feel free to contact our customer support team at <a
        href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a>. Our representatives will be glad to
    assist you.</p>

<p>
    Once again, we appreciate your business and look forward to delivering your order to you soon. Thank you for
    choosing Stickitownit.
</p>
<br>
<p>Kind regards,</p>
<p>Phone: <a href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a><br>Email: <a
        href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
<img src="{{ asset('storage/uploads/settings/'.$setting->logo_header) }}" alt="logo" style="width: 22%">
<br>
<p><a href="https://stickitownit.com">Website</a>&nbsp;&nbsp;<a href="{{$setting->facebook_url}}">Facebook</a>&nbsp;&nbsp;<a
        href="{{$setting->instagram_url}}">Instagram</a></p>


</body>
</html>
