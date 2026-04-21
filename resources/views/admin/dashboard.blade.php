@extends('layouts.admin')

@section('content')
    <div class="animate">
        <h1 style="margin-bottom: 2rem;">Dashboard</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Sales</div>
                <div class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Orders</div>
                <div class="stat-value">{{ $totalOrders }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Products</div>
                <div class="stat-value">{{ $totalProducts }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Pending Orders</div>
                <div class="stat-value">{{ $pendingOrders }}</div>
            </div>
        </div>

        <div class="data-card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.5rem;">Laporan Penjualan Bulanan</h3>
            @if($monthlySales->isEmpty())
                <p style="color: #999; text-align: center; padding: 2rem 0;">
                    Belum ada data penjualan yang selesai (completed).
                </p>
            @else
                <canvas id="salesChart" height="80"></canvas>
            @endif
        </div>

        <div class="data-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3>Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"
                    style="padding: 0.5rem 1rem; font-size: 0.8rem;">View All</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(!$monthlySales->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded',
                function () {
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($monthlySales->pluck('month')->values()) !!},
                            datasets: [{
                                label: 'Penjualan (Rp)',
                                data: {!! json_encode($monthlySales->pluck('total')->map(fn($v) => (float) $v)->values()) !!},
                                backgroundColor: 'rgba(121, 104, 249, 0.7)',
                                borderColor: 'rgba(121, 104, 249, 1)',
                                borderWidth: 2,
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function (ctx) {
                                            return 'Rp ' + ctx.raw.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function (value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        </script>
    @endif
@endsection