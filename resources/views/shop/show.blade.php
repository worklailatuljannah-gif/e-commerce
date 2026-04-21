@extends('layouts.app')

@section('styles')
    <style>
        .product-detail {
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .detail-image {
            width: 100%;
            background: #f8f9fa;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            aspect-ratio: 1;
        }

        .detail-info h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .detail-price {
            font-size: 2rem;
            color: #f71717;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .detail-desc {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .order-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #c09924;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="product-detail">
        <div class="detail-image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    style="width:100%; height:100%; object-fit:cover; border-radius:15px;">
            @else
                @php
                    $icon = match ($product->category) {
                        'Gelas' => '',
                        'Tas/Pouch' => '',
                        'Kipas' => '',
                        'Gantungan Kunci' => '',
                        default => '',
                    };
                    echo $icon;
                @endphp
            @endif
        </div>

        <div class="detail-info">
            <h1>{{ $product->name }}</h1>
            <div class="detail-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            <p class="detail-desc">{{ $product->description ?? 'Souvenir berkualitas dengan desain elegan.' }}</p>

            <div class="order-card">
                <h3>Pesan Sekarang</h3>
                <form id="singleOrderForm" onsubmit="processSingleOrder(event)">
                    <div class="form-group">
                        <label>Nama Pasangan / Pembeli</label>
                        <input type="text" id="custName" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text" id="custContact" required placeholder="0812xxxxxx">
                    </div>
                    <div class="form-group">
                        <label>Alamat Pengiriman</label>
                        <textarea id="custAddr" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kota Pengiriman</label>
                        <select id="custCity" required>
                            <option value="Jakarta">Jabodetabek</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Lainnya">Luar jawa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Pesanan</label>
                        <input type="number" id="custQty" value="100" min="50">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" id="custPostal" pattern="[0-9]{5}" placeholder="12345" required>
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select id="paymentMethodInput" required>
                            <option value="Transfer Bank">Transfer Bank / Virtual Account</option>
                            <option value="E-Wallet">E-Wallet (GoPay, OVO, Dana)</option>
                            <option value="COD">Cash on Delivery (COD)</option>
                        </select>
                    </div>
                    <button type="submit" class="submit-btn" id="submitBtn">✓ Proses Pesanan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        async function processSingleOrder(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'Memproses...';

            const name = document.getElementById('custName').value;
            const contact = document.getElementById('custContact').value;
            const addr = document.getElementById('custAddr').value;
            const city = document.getElementById('custCity').value;
            const qty = parseInt(document.getElementById('custQty').value);
            const postal_code = document.getElementById('custPostal').value;
            const payment_method = document.getElementById('paymentMethodInput').value;

            const productId = {{ $product->id }};
            const productName = "{{ $product->name }}";
            const productPrice = {{ $product->price }};

            try {
                const response = await fetch('{{ route('shop.order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        customer_name: name,
                        customer_phone: contact,
                        address: addr,
                        city: city,
                        postal_code: postal_code,
                        payment_method: payment_method,
                        items: [{
                            id: productId,
                            quantity: qty
                        }]
                    })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    window.location.href = result.redirect_url;
                } else {
                    alert("Terjadi kesalahan: " + (result.message || "Gagal menyimpan pesanan"));
                }
            } catch (error) {
                console.error(error);
                alert("Gagal menghubungi server. Silakan coba lagi.");
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        }
    </script>
@endsection