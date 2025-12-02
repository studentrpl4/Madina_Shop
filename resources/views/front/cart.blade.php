<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('output.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body>
        <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
            <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
                <a href="{{route('front.index')}}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">Keranjang</p>
                <div class="dummy-btn w-10"></div>
            </div>
            <section id="fresh" class="flex flex-col gap-4 px-4 mb-[111px]">

                 @foreach ($carts as $item)
                <div class="flex flex-col gap-4">
                    <a>
                        <div class="flex items-center rounded-3xl p-[10px_16px_16px_10px] gap-[14px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                            <div class="w-20 h-20 flex shrink-0 rounded-2xl bg-[#D9D9D9] overflow-hidden">
                                <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                            </div>
                            <div class="flex w-full items-center justify-between gap-[14px]">
                                <div class="flex flex-col gap-[6px]">
                                    <h3 class="font-bold leading-[20px]">{{ $item->product->name }}</h3>
                                    <p class="text-sm leading-[21px] ">{{ $item->product->category->name }}</p>
                                </div>
                                <p id="cart-subtotal-{{ $item->id }}" class="text-sm text-gray-500">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>

                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <button class="btn-decrease px-3 py-1 bg-gray-300 rounded" data-id="{{ $item->id }}">-</button>
                                <span class="px-3 py-1 border rounded qty-display" data-id="{{ $item->id }}">{{ $item->quantity }}</span>
                                <button class="btn-increase px-3 py-1 bg-green-300 rounded" data-id="{{ $item->id }}">+</button>
                            </div>

                        </div>
                        
                    </a>
                </div>
                  @endforeach

            </section>
            @if($carts->count() > 0)
            <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
                    <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                        <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                            <div class="flex flex-col gap-[2px]">
                                <p id="grand-total" class="font-bold text-[20px] leading-[30px] text-white">Rp {{ number_format($total, 0, ',', '.') }}</p>
                                <p class="text-sm leading-[21px] text-[#878785]">Grand total</p>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold">Continue</a>
                        </div>
                    </div>
                </div>
                @endif
            
        </div>
    <script src="{{asset('js/cart.js')}}"></script>
    </body>
</html>