import React, { useState, useEffect } from 'react';
import Navbar from './components/Navbar.jsx';
import ProductList from './components/ProductList.jsx';

const shippingRates = {
    "Jakarta": 15000,
    "bekasi": 15000,
    "Surabaya": 10000,
    "Malang": 8000,
    "Bandung": 20000,
    "Semarang": 18000,
    "Luar Jawa": 45000
};

function App() {
    const [products, setProducts] = useState([]);
    const [cart, setCart] = useState([]);
    const [isCartOpen, setIsCartOpen] = useState(false);
    const [isCheckoutOpen, setIsCheckoutOpen] = useState(false);
    const [user, setUser] = useState(null);
    const [customerCity, setCustomerCity] = useState('');

    useEffect(() => {
        fetch('/api/api_products.php')
            .then(res => res.json())
            .then(data => setProducts(data));

        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        if (isLoggedIn) {
            setUser({
                id: localStorage.getItem('userId'),
                name: localStorage.getItem('userName'),
                email: localStorage.getItem('userEmail')
            });
        }
    }, []);

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    };

    const addToCart = (product) => {
        setCart(prev => {
            const existing = prev.find(item => item.id === product.id);
            if (existing) return prev.map(i => i.id === product.id ? { ...i, quantity: i.quantity + 1 } : i);
            return [...prev, { ...product, quantity: 1 }];
        });
    };

    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const shippingCost = customerCity ? (shippingRates[customerCity] || 25000) : 0;
    const tax = Math.round(subtotal * 0.11);
    const total = subtotal + shippingCost + tax;

    return (
        <div className="App">
            <Navbar 
                cartCount={cart.reduce((s, i) => s + i.quantity, 0)} 
                toggleCart={() => setIsCartOpen(!isCartOpen)} 
                user={user} 
            />

            <section className="hero" id="home">
                <h1>Selamat Datang di NurArif Souvenir</h1>
                <p>Pusat Souvenir Pernikahan Berkualitas, Murah dan Elegan</p>
                <button className="btn" onClick={() => document.getElementById('products').scrollIntoView({ behavior: 'smooth' })}>
                    Belanja Sekarang
                </button>
            </section>

            <ProductList products={products} addToCart={addToCart} formatRupiah={formatRupiah} />

            {/* Modals can be further componentized later */}
            {isCartOpen && (
                <div className="modal">
                    <div className="modal-content">
                        <h2>Keranjang Belanja</h2>
                        {cart.map(item => (
                            <div key={item.id} className="cart-item">
                                <span>{item.name} (x{item.quantity})</span>
                                <span>{formatRupiah(item.price * item.quantity)}</span>
                            </div>
                        ))}
                        <div className="cart-total">Subtotal: {formatRupiah(subtotal)}</div>
                        <button className="checkout-btn" onClick={() => { setIsCartOpen(false); setIsCheckoutOpen(true); }}>
                            Checkout
                        </button>
                        <button className="close-btn" onClick={() => setIsCartOpen(false)}>&times;</button>
                    </div>
                </div>
            )}

            {isCheckoutOpen && (
                <div className="modal">
                    <div className="modal-content">
                        <h2>Informasi Pengiriman</h2>
                        <select 
                            onChange={(e) => setCustomerCity(e.target.value)} 
                            value={customerCity}
                            style={{ width: '100%', padding: '10px', marginBottom: '10px' }}
                        >
                            <option value="">-- Pilih Kota --</option>
                            {Object.keys(shippingRates).map(city => (
                                <option key={city} value={city}>{city}</option>
                            ))}
                        </select>
                        <div style={{ background: '#f8f9fa', padding: '15px', borderRadius: '8px' }}>
                            <p>Subtotal: {formatRupiah(subtotal)}</p>
                            <p>Ongkir: {formatRupiah(shippingCost)}</p>
                            <p>Pajak (11%): {formatRupiah(tax)}</p>
                            <hr />
                            <p style={{ fontWeight: 'bold', fontSize: '1.2rem', color: '#667eea' }}>Total: {formatRupiah(total)}</p>
                        </div>
                        <button className="checkout-btn" onClick={() => alert('Pesanan diproses!')} style={{ marginTop: '10px' }}>
                            Konfirmasi Pesanan
                        </button>
                        <button className="close-btn" onClick={() => setIsCheckoutOpen(false)}>&times;</button>
                    </div>
                </div>
            )}

            <footer style={{ background: '#2c3e50', color: 'white', textAlign: 'center', padding: '2rem', marginTop: '4rem' }}>
                <p>&copy; 2026 NurArif Souvenir - Framework Version</p>
            </footer>
        </div>
    );
}

export default App;
