<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        // ambil customer yg sedang login
        $customerId = auth('customer')->id();

        // ambil semua item di cart yg punya customer ini
        $cartItems = Cart::with('product')
            ->where('customer_id', $customerId)
            ->get();

        // hitung total harga
        $total = $cartItems->sum('subtotal');

        // kirim ke view
        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
{
    // Validasi
    $request->validate([
        'address' => 'required',
        'payment_method' => 'required'
    ]);

    $customerId = auth('customer')->id();

    // ambil cart
    $cartItems = Cart::with('product')
        ->where('customer_id', $customerId)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang masih kosong!');
    }

    // hitung total
    $total = $cartItems->sum('subtotal');

    // generate invoice code
    $invoice = 'INV-' . strtoupper(Str::random(10));

    // simpan order
    $order = Order::create([
        'customer_id' => $customerId,
        'invoice' => $invoice,
        'address' => $request->address,
        'payment_method' => $request->payment_method,
        'total_price' => $total,
        'status' => 'processing'
    ]);

    // simpan tiap item cart ke order_items
    foreach ($cartItems as $cart) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'price' => $cart->product->price,
            'subtotal' => $cart->subtotal,
        ]);
    }

    // kosongkan cart customer
    Cart::where('customer_id', $customerId)->delete();

    return redirect()->route('customer.orders')
        ->with('success', 'Pesanan berhasil dibuat!');
}
}
