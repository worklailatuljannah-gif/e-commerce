<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima - NurArif Souvenir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f6;
            padding: 2rem;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .receipt-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .receipt-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .receipt-header .logo {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .thank-you {
            background: #f8f9fa;
            padding: 2rem;
            text-align: center;
            border-bottom: 2px solid #e9ecef;
        }

        .thank-you h2 {
            color: #2ecc71;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .order-number {
            font-size: 1.2rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .order-number strong {
            color: #333;
            font-weight: bold;
        }

        .receipt-section {
            padding: 2rem;
            border-bottom: 1px solid #e9ecef;
        }

        .receipt-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #667eea;
        }

        .shipping-info,
        .billing-info {
            display: grid;
            gap: 0.5rem;
        }

        .info-row {
            display: flex;
            gap: 0.5rem;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            min-width: 120px;
        }

        .info-value {
            color: #333;
        }

        .order-items {
            margin-top: 1rem;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .item-quantity {
            color: #666;
            margin: 0 1rem;
        }

        .item-price {
            font-weight: bold;
            color: #667eea;
            min-width: 150px;
            text-align: right;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 1.5rem;
            margin-top: 1rem;
            border-radius: 5px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .summary-row.total {
            border-top: 2px solid #667eea;
            margin-top: 0.5rem;
            padding-top: 1rem;
            font-size: 1.3rem;
            font-weight: bold;
            color: #667eea;
        }

        .tracking-info {
            background: #e3f2fd;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .tracking-info p {
            color: #1976d2;
            margin: 0.25rem 0;
        }

        .tracking-info strong {
            color: #0d47a1;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            padding: 2rem;
            background: #f8f9fa;
            justify-content: center;
        }

        .btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }

        .btn-secondary {
            background: #25D366;
            /* WhatsApp color */
            color: white;
        }

        .btn-secondary:hover {
            background: #1ebe57;
        }

        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .action-buttons {
                display: none;
            }

            .receipt-container {
                box-shadow: none;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .receipt-section {
                padding: 1rem;
            }

            .item-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .item-price {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>NurArif Souvenir</h1>
            <p>Pusat Souvenir Pernikahan Berkualitas</p>
        </div>

        <div class="thank-you">
            <h2>✓ Terima Kasih Atas Pesanan Anda!</h2>
            <p class="order-number">Nomor Pesanan: <strong>{{ $order->order_number }}</strong></p>
            <p style="color: #666; margin-top: 1rem;">Pesanan Anda sedang diproses. Silakan hubungi kami melalui
                WhatsApp untuk konfirmasi/pembayaran.</p>
        </div>

        <div class="receipt-section">
            <div class="tracking-info">
                <p><strong>Informasi Pengiriman:</strong></p>
                <p>Pesanan Anda akan dikirim dalam <strong>1-3 hari kerja</strong></p>
            </div>
        </div>

        <div class="receipt-section">
            <div class="section-title">Informasi Pengiriman</div>
            <div class="shipping-info">
                <div class="info-row">
                    <span class="info-label">Nama Penerima:</span>
                    <span class="info-value">{{ $order->customer_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">WhatsApp:</span>
                    <span class="info-value">{{ $order->customer_phone }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat & Kota:</span>
                    <span class="info-value">{{ $order->address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kode Pos:</span>
                    <span class="info-value">{{ $order->postal_code }}</span>
                </div>
            </div>
        </div>

        <div class="receipt-section">
            <div class="section-title">Detail Pesanan</div>
            <div class="order-items">
                @foreach($order->items_json as $item)
                    <div class="item-row">
                        <div class="item-details">
                            <div class="item-name">{{ $item['name'] }}</div>
                        </div>
                        <div class="item-quantity">Jumlah: {{ $item['quantity'] }}</div>
                        <div class="item-price">Rp {{ number_format($item['price'], 0, ',', '.') }} ×
                            {{ $item['quantity'] }} = Rp {{ number_format($item['total'], 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Biaya Pengiriman:</span>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Pajak (11%):</span>
                    <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="receipt-section">
            <div class="section-title">Metode Pembayaran</div>
            <div class="billing-info">
                <div class="info-row">
                    <span class="info-label">Metode:</span>
                    <span class="info-value">{{ $order->payment_method }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value" style="color: #2ecc71; font-weight: bold;">✓ Menunggu Pembayaran via
                        WhatsApp</span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-outline" onclick="window.print()">🖨️ Cetak</button>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">← Beranda</a>
            <button class="btn btn-secondary" onclick="sendToWhatsapp()">📲 Konfirmasi ke WhatsApp</button>
        </div>
    </div>

    <script>
        function sendToWhatsapp() {
            let text = `Halo NurArif Souvenir, saya *{{ $order->customer_name }}*\n`;
            text += `Konfirmasi pesanan dengan Nomor: *{{ $order->order_number }}*\n\n`;
            text += `Total Pembayaran: *Rp {{ number_format($order->total, 0, ',', '.') }}*\n`;
            text += `\nAlamat Pengiriman:\n{{ $order->address }}`;

            const url = `https://wa.me/6282258406966?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
        }
    </script>
</body>

</html>