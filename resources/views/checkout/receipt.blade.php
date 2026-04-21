<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>e-Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #ba68c8;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 2em;
            color: #6a1b9a;
            font-weight: bold;
        }
        .receipt-title {
            color: #4caf50;
            font-size: 1.5em;
            margin: 10px 0;
        }
        .order-info {
            background: #f7e8fb;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th, .items-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .items-table th {
            background: #f0f0f0;
        }
        .total {
            font-size: 1.3em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #6a1b9a;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
        }
        .barcode {
            text-align: center;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 1.2em;
            letter-spacing: 2px;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">NextMart</div>
        <div class="receipt-title">e-RECEIPT</div>
        <div>Order Confirmation</div>
    </div>

    <div class="order-info">
        <div class="info-row">
            <strong>Receipt #{{ $order->id }}</strong>
            <span>Date: {{ $order->created_at->format('M d, Y h:i A') }}</span>
        </div>
        <div class="info-row">
            <span>Customer: {{ $order->user->name }}</span>
            <span>{{ $order->user->email }}</span>
        </div>
        @if($order->user->address)
        <div class="info-row">
            <span>Address: {{ $order->user->address }}</span>
            <span>Phone: {{ $order->user->phone ?? 'N/A' }}</span>
        </div>
        @endif
        <div class="info-row">
            <span>Payment: {{ strtoupper($order->payment_method) }}</span>
            <span>Status: {{ ucfirst($order->payment_status) }}</span>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }} {{ $item->variation ? '(' . $item->variation . ')' : '' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>PHP {{ number_format($item->price, 2) }}</td>
                <td>PHP {{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Grand Total: PHP {{ number_format($order->total_amount, 2) }}
    </div>

    <div class="barcode">
        *** ORDER #{{ $order->id }} ***
    </div>

    <div class="footer">
        <p>Thank you for shopping with NextMart!</p>
        <p>This is an electronic receipt. Please keep for your records.</p>
        <p>Customer Service: support@nextmart.com</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
