<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('output.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </head>
    <body>
        <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
            <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
                <a href="#">
                    <img src="{{asset('assets//images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">Checkout</p>
                <div class="dummy-btn w-10"></div>
            </div>

            @foreach ($cartItems as $item)
            <div class="flex items-center rounded-3xl gap-[14px] p-[10px_16px_16px_10px] bg-white mx-4">
                <div class="flex shrink-0 w-20 h-20 rounded-2xl p-1 overflow-hidden">
                    <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-contain" alt="">
                </div>
                <div class="flex flex-col w-full">
                    <h1 id="title" class="font-bold text-lg leading-6">{{ $item->product->name }}</h1>
                    <p class="font-semibold text-sm leading-[21px]">{{ $item->quantity }} Pcs</p>
                </div>
                <div class="flex items-center shrink-0 gap-1">
                    <p class="font-semibold">
                    Rp {{ number_format($item->subtotal,0,',','.') }}
                </p>
                </div>
            </div>
             @endforeach
            <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <div class="flex flex-col rounded-[20px] p-4 mx-4 pb-5 gap-5 bg-white">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <h1 id="title" class="font-bold text-[22px] leading-9[30px]">Alamat Pengiriman</h1>
                        </div>
                    </div>
                    <hr class="border-[#EAEAED]">
                    <div class="flex flex-col gap-2">
                        <label for="address" class="font-semibold">Masukan Alamat Lengkap</label>
                        <div class="flex items-start w-full rounded-[18px] ring-1 ring-[#090917] p-[14px] gap-[10px] overflow-hidden transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                            <img src="{{asset('assets//images/icons/house-2.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                            <textarea name="address" id="address" rows="6" class="appearance-none outline-none w-full font-semibold placeholder:font-normal placeholder:text-[#878785]" placeholder="Type your full address"></textarea>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl flex flex-col gap-2">
            <label class="font-semibold">Metode Pembayaran</label>

            <select name="payment_method" class="w-full p-2 rounded-xl border" required>
                <option value="">-- pilih metode --</option>
                <option value="cod">Bayar di tempat (COD)</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>
                </div>
                <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
                    <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                        <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                            <div class="flex flex-col gap-[2px]">
                                <p id="grand-total" class="font-bold text-[20px] leading-[30px] text-white">Rp {{ number_format($total, 0, ',', '.') }}</p>
                                <p class="text-sm leading-[21px] text-[#878785]">Grand total</p>
                            </div>
                            <button type="submit" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>