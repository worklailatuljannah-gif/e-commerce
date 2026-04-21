import React from 'react';

const Navbar = ({ cartCount, toggleCart, user }) => (
    <header>
        <nav>
            <a href="#" className="logo">🛒 NurArif Souvenir</a>
            <ul className="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Produk</a></li>
                {!user && <li><a href="/login.html">Login</a></li>}
            </ul>
            <div className="cart-icon" onClick={toggleCart}>
                🛒 <span className="cart-count">{cartCount}</span>
            </div>
        </nav>
    </header>
);

export default Navbar;
