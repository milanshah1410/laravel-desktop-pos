<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $sale->id }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/fonts/DejaVuSans.ttf") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            margin: 40px;
        }

        h2,
        h3,
        h4 {
            margin: 5px 0;
        }

        .header,
        .totals {
            margin-bottom: 20px;
        }

        .header p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #f0f0f0;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .totals {
            margin-top: 20px;
            text-align: right;
        }

        .totals h3,
        .totals h4 {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>🧾 Invoice #{{ $sale->id }}</h2>
        <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y h:i A') }}</p>
        <p><strong>Customer:</strong> {{ $sale->customer->name ?? 'Walk-in' }} ({{ $sale->customer->mobile ?? '-' }})</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <h4>Subtotal: ₹{{ number_format($sale->subtotal, 2) }}</h4>
        <h4>Discount: ₹{{ number_format($sale->discount, 2) }}</h4>
        <h3><strong>Grand Total: ₹{{ number_format($sale->total, 2) }}</strong></h3>
        <h3>Paid: ₹{{ number_format($sale->paid, 2) }}</h3>
    </div>
</body>

</html>