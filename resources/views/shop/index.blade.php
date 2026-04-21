@extends('layouts.app')

@section('styles')
    <style>
        .hero {
            position: relative;
            text-align: center;
            color: #e5b300;
            padding: 10rem 5rem;
            overflow: hidden;
            z-index: 2;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: 90vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .btn {
            background: #ceaa27;
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: transform 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .category-filter {
            max-width: 2000px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-btn {
            padding: 0.5rem 1.5rem;
            border: 2px solid#e9d27f;
            background: white;
            color: #6d6d6b;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .category-btn:hover,
        .category-btn.active {
            background: #ecc741;
            color: rgb(57, 57, 57);
        }

        .products {
            max-width: 2000px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .products h2 {
            font-family: 'Playfair Display', serif;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #ceaa27;
            margin-top: 3rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .product-info {
            padding: 2rem;
        }

        .product-name {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            color: #e70000;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .add-to-cart {
            width: 100%;
            padding: 0.8rem;
            background: #ceaa27;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
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
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .products-wrapper {
            background-color: #ffffff;
            padding: 50px 0;
        }

        .about-section {
            width: 100%;
            background-color: #f9f9f9;
            padding: 100px 0;
            margin: 0;
        }

        .testimonials-section {
            width: 100%;
            background-color: #ffffff;
            padding: 100px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .about-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .about-header h1 {
            font-size: 3.5rem;
            color: #c09924;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: capitalize;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 9rem;
            align-items: center;
        }

        .about-image img {
            width: 110%;
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(240, 204, 102, 0.08);
            display: block;
        }

        .about-text h2 {
            font-size: 2.5rem;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #c09924;
            margin-bottom: 1.5rem;
        }

        .about-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 1.5rem;
            text-align: justify;
        }


        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .testimonial-card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            border: 1px solid #eee;
        }

        .stars {
            color: #ffc107;
            letter-spacing: 2px;
            font-size: 0.9rem;
        }

        .testimonial-text {
            font-style: italic;
            color: #555;
            line-height: 1.7;
            font-size: 1rem;
        }

        .testimonial-author {
            margin-top: auto;
        }

        .author-name {
            font-weight: 700;
            color: #333;
            font-size: 0.95rem;
        }

        .author-loc {
            font-size: 0.8rem;
            color: #484848;
        }

        @media (max-width: 968px) {
            .about-content {
                grid-template-columns: 1fr;
                gap: 4rem;
                text-align: center;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="hero-section">
        <video autoplay muted loop playsinline class="bg-video">
            <source src="{{ asset('video/vidiobanner.mp4') }}" type="video/mp4">
        </video>
        <section class="hero">
            <h1>Selamat Datang di Nur Arif Souvenir</h1>
            <p>Pusat Souvenir Pernikahan Berkualitas, Murah dan Elegan</p>
            <button class="btn" onclick="document.getElementById('products')?.scrollIntoView({behavior:'smooth'})">Belanja
                Sekarang</button>
        </section>
    </div>

    <div class="products-wrapper">
        <section class="category-filter container">
            <button class="category-btn active" onclick="filterCategory('semua', this)">Semua</button>
            <button class="category-btn" onclick="filterCategory('gelas', this)">Gelas</button>
            <button class="category-btn" onclick="filterCategory('tas/pouch', this)">Tas/Pouch</button>
            <button class="category-btn" onclick="filterCategory('kipas', this)">Kipas</button>
            <button class="category-btn" onclick="filterCategory('gantungan kunci', this)">Gantungan Kunci</button>
            <button class="category-btn" onclick="filterCategory('lainnya', this)">Lainnya</button>
        </section>

        <section class="products container" id="products">
            <h2>Produk Populer</h2>
            <div class="product-grid" id="productGrid">
                @foreach($products as $product)
                    <div class="product-card" data-category="{{ strtolower($product->category ?? 'lainnya') }}">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <span style="font-size: 1.5rem; color: #aaa;"> </span>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})"
                                class="add-to-cart">
                                Tambah Keranjang
                            </button>
                        </div>
                    </div>
                @endforeach
                <div id="noResultMsg" style="display:none; grid-column:1/-1; text-align:center; padding:3rem; color:#999;">
                    <div style="font-size:3rem;">🔍</div>
                    <p style="margin-top:0.5rem; font-size:1.1rem;">Produk tidak ditemukan</p>
                    <p style="font-size:0.9rem;">Coba kata kunci lain atau pilih kategori berbeda</p>
                </div>
            </div>
        </section>
    </div>

    <section class="about-section" id="about">
        <div class="container">
            <div class="about-header">
                <h1>Tentang Kami</h1>
                <div class="underline"></div>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <img src="{{ asset('img/nurarif.jpeg') }}" alt="Kisah Kami">
                </div>
                <div class="about-text">
                    <p>
                        NurArif Souvenir hadir dengan satu tujuan: mengabadikan momen terindah dalam hidup Anda melalui
                        karya yang elegan dan tak lekang oleh waktu. Kami memahami bahwa pernikahan adalah awal dari
                        sebuah
                        perjalanan panjang, dan setiap detailnya berhak dikenang.
                    </p>
                    <p>
                        Setiap souvenir yang kami buat dikerjakan dengan penuh ketelitian, menggabungkan desain modern
                        dan
                        sentuhan berkelas. Kami memilih material terbaik untuk memastikan setiap produk tidak hanya
                        indah
                        dilihat, tetapi juga bermakna bagi setiap tamu yang menerimanya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="about-header">
                <h1>Apa Kata Mereka</h1>
                <div class="underline"></div>
                <p style="margin-top: 1rem; color: #777;">Kesan tulus dari pelanggan kebanggaan kami.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Souvenirnya benar-benar di luar ekspektasi! Sangat elegan dan tamu-tamu
                        kami terus memuji betapa mewahnya detail yang diberikan. Terima kasih NurArif Souvenir."</p>
                    <div class="testimonial-author">
                        <div class="author-name">Amanda & Reza</div>
                        <div class="author-loc">Jakarta</div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Pesan jarak jauh biasa jadi sangat berisiko, tapi NurArif meyakinkan
                        kami.
                        Packaging-nya sangat rapi dan aman sampai ke lokasi acara. Sangat direkomendasikan untuk calon
                        pengantin."</p>
                    <div class="testimonial-author">
                        <div class="author-name">Davinna & Dian</div>
                        <div class="author-loc">Bali</div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Admin benar-benar membantu kami! Desain grafir-nya sangat cantik dan
                        berkualitas tinggi. Proses pemesanan sangat mudah dan timnya responsif mendengarkan setiap
                        request
                        kami."</p>
                    <div class="testimonial-author">
                        <div class="author-name">Indah & Kevin</div>
                        <div class="author-loc">Bandung</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal" id="cartModal">
        <div class="modal-content">
            <h2 style="color: #ceaa27; margin-bottom: 1.5rem;">Keranjang Belanja</h2>
            <div id="cartItemsList" style="margin-bottom: 1rem;"></div>
            <div style="border-top: 2px solid #eee; padding-top: 1rem;">
                <div
                    style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem;">
                    <span>Total:</span>
                    <span id="cartTotalDisplay">Rp 0</span>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button onclick="toggleCart(false)" class="btn"
                        style="background:#eee; color:#666; flex: 1;">Tutup</button>
                    <button onclick="goToCheckout()" class="btn"
                        style="background:#ceaa27; color:white; flex: 2; border-radius: 8px;">Lanjut Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="checkoutModal">
        <div class="modal-content">
            <h2 style="color: #ceaa27; margin-bottom: 1.5rem;">Informasi Pengiriman</h2>
            <form onsubmit="processOrder(event)">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="custName" required placeholder="Contoh: Budi Santoso">
                </div>
                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    <input type="text" id="custContact" required placeholder="0812xxxxxx">
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea id="custAddr" rows="3" required
                        placeholder="Nama jalan, nomor rumah, kec, kota..."></textarea>
                </div>
                <div class="form-group">
                    <label>Kota Pengiriman</label>
                    <select id="custCity" onchange="updateShippingCost()" required>
                        <option value="">-- Pilih Kota --</option>
                        <option value="Jabodetabek">Jabodetabek (Rp15.000)</option>
                        <option value="Surabaya">Surabaya (Rp10.000)</option>
                        <option value="Malang">Malang (Rp15.000)</option>
                        <option value="Bandung">Bandung (Rp20.000)</option>
                        <option value="Semarang">Semarang (Rp18.000)</option>
                        <option value="Luar Jawa">Luar Jawa (Rp45.000)</option>
                    </select>
                </div>

                <div id="checkoutSummary"
                    style="margin-top: 1.5rem; padding: 1rem; background: #ffffff; border-radius: 8px; border: 1px solid #000000; margin-bottom: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span>Subtotal:</span>
                        <span id="displaySubtotal">Rp 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span>Ongkos Kirim:</span>
                        <span id="displayShippingCost">Rp 0</span>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; color: #666; font-size: 0.9rem;">
                        <span>Pajak (11%):</span>
                        <span id="displayTax">Rp 0</span>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-weight: bold; font-size: 1.1rem; color: #000000; border-top: 1px solid #ddd; padding-top: 0.5rem;">
                        <span>Total Bayar:</span>
                        <span id="displayTotal">Rp 0</span>
                    </div>
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

                <div style="display: flex; gap: 10px;">
                    <button type="button" onclick="toggleCheckout(false)" class="btn"
                        style="background:#eee; color:#666; flex: 1;">Batal</button>
                    <button type="submit" class="btn"
                        style="background:#ceaa27 ; color:white; flex: 2; border-radius: 8px;">Proses Pesanan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        let cart = JSON.parse(localStorage.getItem('cart')) || [];


        document.addEventListener('DOMContentLoaded', () => {
            updateCartBadge();

            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase();
                    const products = document.querySelectorAll('.product-card');
                    let hasResults = false;

                    products.forEach(p => {
                        const name = p.querySelector('.product-name').textContent.toLowerCase();
                        if (name.includes(query)) {
                            p.style.display = 'block';
                            hasResults = true;
                        } else {
                            p.style.display = 'none';
                        }
                    });

                    document.getElementById('noResultMsg').style.display = hasResults ? 'none' : 'block';
                    if (query === '') {

                        const activeCategory = document.querySelector('.category-btn.active').getAttribute('onclick').match(/'([^']+)'/)[1];
                        filterCategory(activeCategory, document.querySelector('.category-btn.active'));
                    }
                });
            }
        });

        function addToCart(id, name, price) {
            const itemIndex = cart.findIndex(item => item.id === id);
            if (itemIndex > -1) {
                cart[itemIndex].quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            saveCart();
            updateCartBadge();
        }
        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function updateCartBadge() {
            const badge = document.getElementById('cartCount');
            if (badge) {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                badge.innerText = totalItems;
            }
        }

        function toggleCart(show) {
            const modal = document.getElementById('cartModal');
            if (show) {
                updateCartDisplay();
                modal.classList.add('active');
            } else {
                modal.classList.remove('active');
            }
        }

        function updateCartDisplay() {
            const list = document.getElementById('cartItemsList');
            const totalDisplay = document.getElementById('cartTotalDisplay');
            list.innerHTML = '';

            if (cart.length === 0) {
                list.innerHTML = '<p style="text-align:center; color:#999; padding:1rem;">Keranjang kosong</p>';
                totalDisplay.innerText = 'Rp 0';
                return;
            }

            let total = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                const itemEl = document.createElement('div');
                itemEl.style.display = 'flex';
                itemEl.style.justifyContent = 'space-between';
                itemEl.style.alignItems = 'center';
                itemEl.style.marginBottom = '1rem';
                itemEl.style.padding = '0.5rem';
                itemEl.style.borderBottom = '1px solid #eee';

                itemEl.innerHTML = `
                                                <div style="flex:1;">
                                                    <div style="font-weight:bold;">${item.name}</div>
                                                    <div style="font-size:0.9rem; color:#666;">Rp ${item.price.toLocaleString('id-ID')} x ${item.quantity}</div>
                                                </div>
                                                <div style="display:flex; align-items:center; gap:10px;">
                                                    <span style="font-weight:bold;">Rp ${itemTotal.toLocaleString('id-ID')}</span>
                                                    <button onclick="removeFromCart(${index})" style="background:none; border:none; color:#ff4757; cursor:pointer; font-size:1.2rem;">&times;</button>
                                                </div>
                                            `;
                list.appendChild(itemEl);
            });

            totalDisplay.innerText = `Rp ${total.toLocaleString('id-ID')}`;
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            saveCart();
            updateCartBadge();
            updateCartDisplay();
        }

        function goToCheckout() {
            if (cart.length === 0) {
                alert('Keranjang Anda masih kosong!');
                return;
            }
            toggleCart(false);
            toggleCheckout(true);
        }

        function toggleCheckout(show) {
            const modal = document.getElementById('checkoutModal');
            if (show) {
                modal.classList.add('active');
                updateShippingCost();
            } else {
                modal.classList.remove('active');
            }
        }

        function updateShippingCost() {
            const city = document.getElementById('custCity').value;
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            const shippingRates = {
                'Jabodetabek': 15000,
                'Surabaya': 10000,
                'Malang': 15000,
                'Bandung': 20000,
                'Semarang': 18000,
                'Luar Jawa': 45000
            };

            const shippingCost = shippingRates[city] || 0;
            const tax = Math.round(subtotal * 0.11);
            const total = subtotal + shippingCost + tax;

            document.getElementById('displaySubtotal').innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
            document.getElementById('displayShippingCost').innerText = `Rp ${shippingCost.toLocaleString('id-ID')}`;
            document.getElementById('displayTax').innerText = `Rp ${tax.toLocaleString('id-ID')}`;
            document.getElementById('displayTotal').innerText = `Rp ${total.toLocaleString('id-ID')}`;
        }

        async function processOrder(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = 'Memproses...';

            const orderData = {
                customer_name: document.getElementById('custName').value,
                customer_phone: document.getElementById('custContact').value,
                address: document.getElementById('custAddr').value,
                city: document.getElementById('custCity').value,
                postal_code: document.getElementById('custPostal').value,
                payment_method: document.getElementById('paymentMethodInput').value,
                items: cart.map(item => ({
                    id: item.id,
                    quantity: item.quantity
                }))
            };

            try {
                const response = await fetch('{{ route('shop.order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(orderData)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    localStorage.removeItem('cart');
                    cart = [];
                    window.location.href = result.redirect_url;
                } else {
                    alert('Gagal memproses pesanan: ' + result.message);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        }


        function filterCategory(category, btn) {

            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const products = document.querySelectorAll('.product-card');
            let hasResults = false;

            products.forEach(p => {
                const pCategory = p.getAttribute('data-category').toLowerCase();
                if (category === 'semua' || pCategory === category.toLowerCase()) {
                    p.style.display = 'block';
                    hasResults = true;
                } else {
                    p.style.display = 'none';
                }
            });

            document.getElementById('noResultMsg').style.display = hasResults ? 'none' : 'block';
        }
    </script>
@endsection