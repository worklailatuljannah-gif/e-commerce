@extends('layouts.admin')

@section('content')
    <div class="animate">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Manage Souvenirs</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
        </div>

        <div class="data-card">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div
                                        style="width: 50px; height: 50px; background: #eee; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        N/A</div>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    style="color: #2980b9; margin-right: 1rem; text-decoration: none;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="color: #e74c3c; background: none; border: none; cursor: pointer; font-family: inherit;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top: 1.5rem;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection