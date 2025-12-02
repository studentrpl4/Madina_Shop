<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('output.css')}}" rel="stylesheet">
</head>
<body>
<div class="max-w-[640px] mx-auto min-h-screen bg-[#F5F5F0]">

    <div class="flex justify-between items-center px-4 mt-[60px]">
        <a href="{{ route('front.index') }}">
            <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-10 h-10">
        </a>
        <p class="font-bold text-lg">Pesanan Saya</p>
        <div class="w-10"></div>
    </div>

    {{-- TAB --}}
    <div class="flex px-4 mt-6 gap-4">
        <button id="btn-ongoing" class="tab-active">Sedang Diproses</button>
        <button id="btn-history" class="tab">Riwayat</button>
    </div>

    {{-- ONGOING --}}
    <div id="ongoing-section" class="px-4 mt-4 flex flex-col gap-4">
        @forelse ($ongoing as $order)
            <div class="p-4 bg-white rounded-2xl">
                <p class="font-bold">Invoice: {{ $order->invoice }}</p>
                <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <a href="{{ route('orders.show', $order->id) }}"
               class="mt-2 inline-block px-4 py-2 bg-[#C5F277] text-black font-bold rounded">
                Lihat Detail
            </a>
            </div>

        @empty
            <p class="text-center mt-6 text-gray-500">Belum ada pesanan.</p>
        @endforelse
    </div>

    {{-- HISTORY --}}
    <div id="history-section" class="px-4 mt-4 flex flex-col gap-4 hidden">
        @forelse ($history as $order)
            <div class="p-4 bg-white rounded-2xl">
                <p class="font-bold">Invoice: {{ $order->invoice }}</p>
                <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <a href="{{ route('orders.show', $order->id) }}"
               class="mt-2 inline-block px-4 py-2 bg-[#C5F277] text-black font-bold rounded">
                Lihat Detail
            </a>
            </div>
        @empty
            <p class="text-center mt-6 text-gray-500">Tidak ada riwayat.</p>
        @endforelse
    </div>

</div>

<script>
    const btnOngoing = document.getElementById('btn-ongoing');
    const btnHistory = document.getElementById('btn-history');
    const ongoing = document.getElementById('ongoing-section');
    const history = document.getElementById('history-section');

    btnOngoing.addEventListener('click', () => {
        btnOngoing.classList.add('tab-active');
        btnHistory.classList.remove('tab-active');
        ongoing.classList.remove('hidden');
        history.classList.add('hidden');
    });

    btnHistory.addEventListener('click', () => {
        btnHistory.classList.add('tab-active');
        btnOngoing.classList.remove('tab-active');
        history.classList.remove('hidden');
        ongoing.classList.add('hidden');
    });
</script>

<style>
    .tab { padding: 8px 16px; border-radius: 999px; background: #E0E0E0; }
    .tab-active { padding: 8px 16px; border-radius: 999px; background: #C5F277; font-weight: bold; }
</style>

</body>
</html>
