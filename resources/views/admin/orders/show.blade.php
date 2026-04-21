@extends('layouts.admin')

@section('content')
    <div class="animate">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>Order Details: {{ $order->order_number }}</h1>
            <a href="{{ route('admin.orders.index') }}" class="btn" style="background: #eee;">Back to List</a>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            <div class="data-card">
                <h3>Items Ordered</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: right;">Total Amount:</th>
                            <th>Rp {{ number_format($order->total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="data-card">
                <h3>Customer Info</h3>
                <div style="margin-top: 1rem;">
                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Phone / WhatsApp:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Address:</strong><br>{{ $order->address }}</p>
                    <p><strong>Postal Code:</strong> {{ $order->postal_code ?? '-' }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method ?? '-' }}</p>
                </div>

                <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #000000;">

                <h3>Update Status</h3>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="margin-top: 1rem ;">
                    @csrf
                    @method('PATCH')
                    <div class="field">
                        <select name="status">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Shipping</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
                </form>
            </div>
        </div>
    </div>
@endsection