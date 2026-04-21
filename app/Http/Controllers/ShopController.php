<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('shop.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop.show', compact('product'));
    }

    public function placeOrder(Request $request)
    {
 
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
        ]);

        $subtotal = 0;
        $orderItems = [];
        
    
        foreach ($request->items as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $itemTotal = $product->price * $item['quantity'];
                $subtotal += $itemTotal;
                
                $orderItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float)$product->price,
                    'quantity' => (int)$item['quantity'],
                    'total' => (float)$itemTotal
                ];
                // Stock decrement removed
            }
        }

        $city = $request->city;
        $shippingRates = [
            'Jabodetabek' => 15000,
            'Surabaya' => 10000,
            'Malang' => 15000,
            'Bandung' => 20000,
            'Semarang' => 18000,
            'Luar Jawa' => 45000
        ];
        $shipping_cost = $shippingRates[$city] ?? 25000;

        $tax = round($subtotal * 0.11);
        $total = $subtotal + $shipping_cost + $tax;

      
        $order = Order::create([
            'order_number' => 'NAS-' . date('Ymd') . strtoupper(Str::random(6)),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_phone . '@whatsapp', 
            'customer_phone' => $request->customer_phone,
            'address' => $request->address . ' (' . $city . ')',
            'postal_code' => $request->postal_code,
            'payment_method' => $request->payment_method,
            'items_json' => $orderItems,
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'tax' => $tax,
            'total' => $total,
            'status' => 'pending',
        ]);


        foreach($orderItems as $oi) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $oi['id'],
                'quantity' => $oi['quantity'],
                'price' => $oi['price'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil disimpan',
            'redirect_url' => route('shop.receipt', ['order_number' => $order->order_number])
        ]);
    }

    public function receipt($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        return view('shop.receipt', compact('order'));
    }
}
