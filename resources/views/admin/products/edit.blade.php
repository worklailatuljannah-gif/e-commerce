@extends('layouts.admin')

@section('content')
    <div class="animate" style="max-width: 800px;">
        <h1 style="margin-bottom: 2rem;">Edit Souvenir</h1>

        <div class="data-card">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="field">
                    <label for="category">Kategori</label>
                    <select id="category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Gelas" {{ $product->category == 'Gelas' ? 'selected' : '' }}>Gelas</option>
                        <option value="Tas/Pouch" {{ $product->category == 'Tas/Pouch' ? 'selected' : '' }}>Tas/Pouch</option>
                        <option value="Kipas" {{ $product->category == 'Kipas' ? 'selected' : '' }}>Kipas</option>
                        <option value="Gantungan Kunci" {{ $product->category == 'Gantungan Kunci' ? 'selected' : '' }}>
                            Gantungan Kunci</option>
                        <option value="Lainnya" {{ $product->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: end;">
                    <div class="field">
                        <label for="price">Price (IDR)</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="field">
                        <label for="image">Change Image</label>
                        @if($product->image)
                            <div style="margin-bottom: 0.5rem; font-size: 0.8rem; color: #666;">Current: {{ basename($product->image) }}</div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn" style="background: #eee;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection