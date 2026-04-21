@extends('layouts.admin')

@section('content')
    <div class="animate" style="max-width: 800px;">
        <h1 style="margin-bottom: 2rem;">Add New Souvenir</h1>

        <div class="data-card">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required placeholder="e.g. Gelas Cantik Motif Bunga">
                </div>

                <div class="field">
                    <label for="category">Kategori</label>
                    <select id="category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Gelas">Gelas</option>
                        <option value="Tas/Pouch">Tas/Pouch</option>
                        <option value="Kipas">Kipas</option>
                        <option value="Gantungan Kunci">Gantungan Kunci</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="field">
                        <label for="price">Price (IDR)</label>
                        <input type="number" id="price" name="price" required placeholder="15000">
                    </div>
                    <div class="field">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn" style="background: #eee;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection