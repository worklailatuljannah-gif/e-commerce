<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        header {
            background: rgba(180, 180, 177, 0.95);
            backdrop-filter: blur(10px);
            color: #333;
            padding: 0.5rem 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .logo img {
            height: 60px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo:hover img {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #2d3436;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 5px 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #333333;
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #333333;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .user-status-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cart-icon {
            position: relative;
            color: #333;
            display: flex;
            align-items: center;
        }

        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff4757;
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(180, 180, 177, 0.95);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }


        footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            margin-top: 6rem;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, #667eea, #764ba2);
        }

        footer p {
            max-width: 600px;
            margin: 0.5rem auto;
            opacity: 0.7;
            font-weight: 300;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 4px 4px 4px 16px;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
            width: 300px;
        }

        .search-bar:focus-within {
            background: rgba(255, 255, 255, 0.6);
            width: 350px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-color: rgba(255, 255, 255, 0.9);
        }

        .search-input {
            flex: 1;
            padding: 6px 0;
            border: none;
            background: transparent;
            color: #333;
            outline: none;
            font-size: 0.9rem;
            font-family: inherit;
        }

        .search-input::placeholder {
            color: rgba(0, 0, 0, 0.4);
        }

        .search-btn {
            background: #9d9d9c;
            border: none;
            border-radius: 50%;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-btn:hover {
            background: #ceaa27;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
    @yield('styles')
</head>

<body>
    <header>
        <nav>
            <a href="/" class="logo">
                <img src="{{ asset('img/logonurarifsouvenir.png') }}" alt="NurArif Souvenir Logo">
            </a>
            <div class="search-bar">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari produk..."
                    autocomplete="off">
                <button class="search-btn"
                    onclick="document.getElementById('products')?.scrollIntoView({behavior:'smooth'})">🔍</button>
            </div>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="#products">Produk</a></li>
                <li><a href="{{ route('contact') }}">Kontak</a></li>
                <li><a href="{{ route('pemesanan') }}">Cara Pemesanan</a></li>
            </ul>
            <div class=" user-status-icons">
                <div class="cart-icon-wrapper" onclick="toggleCart(true)">
                    <div class="cart-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="cart-badge" id="cartCount">0</span>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer>
        <p>&copy; {{ date('Y') }} NurArif Souvenir</p>
        <p> </p>
    </footer>

    @yield('scripts')
</body>

</html>