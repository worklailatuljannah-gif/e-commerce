<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
use Illuminate\Support\Facades\DB;

echo "Total orders: " . Order::count() . "\n";
echo "Completed orders: " . Order::where('status','completed')->count() . "\n";
echo "All statuses:\n";
$statuses = Order::select('status', DB::raw('count(*) as count'))->groupBy('status')->get();
foreach($statuses as $s) {
    echo "  - {$s->status}: {$s->count}\n";
}

echo "\nMonthly sales data:\n";
$data = Order::where('status','completed')
    ->select(
        DB::raw('SUM(total) as total'),
        DB::raw("DATE_FORMAT(created_at, '%M %Y') as month"),
        DB::raw("DATE_FORMAT(created_at, '%Y%m') as month_order")
    )
    ->groupBy('month', 'month_order')
    ->orderBy('month_order')
    ->get();

foreach($data as $d) {
    echo "  {$d->month}: Rp " . number_format($d->total, 0, ',', '.') . "\n";
}
if($data->isEmpty()) echo "  (kosong - tidak ada order completed)\n";
