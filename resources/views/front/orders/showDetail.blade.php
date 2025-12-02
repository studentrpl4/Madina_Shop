<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link href="{{ asset('output.css') }}" rel="stylesheet">
</head>
<body class="bg-[#F5F5F0]">

<div class="max-w-[640px] mx-auto p-4">

    <div class="flex justify-between items-center mb-4">
        <a href="{{ url()->previous() }}" class="text-lg font-bold">&larr; Kembali</a>
        <p class="text-xl font-bold">Detail Pesanan</p>
    </div>

    <div class="bg-white p-4 rounded-xl mb-4">
        <p><strong>Nama:</strong> {{ $order->customer->name }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    </div>

    <h2 class="text-lg font-semibold mb-2">Produk yang dipesan</h2>

    @foreach($order->order_items as $item)
        <div class="bg-white p-4 rounded-xl mb-2 flex justify-between items-center">
            <div>
                <p class="font-bold">{{ $item->product->name }}</p>
                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
            </div>
            <p class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
        </div>
    @endforeach

    <div class="bg-white p-4 rounded-xl mt-4">
        <p class="font-bold text-lg">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    </div>

</div>

</body>
</html>
