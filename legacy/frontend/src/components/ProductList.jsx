import React from 'react';

const ProductList = ({ products, addToCart, formatRupiah }) => (
    <section className="products" id="products">
        <div className="product-grid">
            {products.map(product => (
                <div key={product.id} className="product-card">
                    <div className="product-image">{product.icon || '🎁'}</div>
                    <div className="product-info">
                        <div className="product-name">{product.name}</div>
                        <div className="product-price">{formatRupiah(product.price)}</div>
                        <button className="add-to-cart" onClick={() => addToCart(product)}>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            ))}
        </div>
    </section>
);

export default ProductList;
