@extends('layouts.admin')

@section('content')
    <div class="animate">
        <h1 style="margin-bottom: 2rem;">Customer Orders</h1>

        <div class="data-card">
            <table>
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    style="color: var(--primary); font-weight: 600; text-decoration: none;">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top: 1.5rem;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection