<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hofu Coffee Monthly Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 50px;
        }
        .header h2 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hofu Coffee Monthly Report on {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Order ID</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    <td>{{ $order->id }}</td>
                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Sales:</strong> Rp{{ number_format($orders->sum('total_price'), 0, ',', '.') }}</p>
</body>
</html>