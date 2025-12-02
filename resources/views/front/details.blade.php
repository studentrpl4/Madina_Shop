<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('output.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    </head>
    <body>
        <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
            <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
                <a href="{{route('front.index')}}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">Look Details</p>
                <div class="dummy-btn w-10"></div>
            </div>
            <section id="gallery" class="flex flex-col gap-[10px]">
                <div class="flex w-full h-[250px] shrink-0 overflow-hidden px-4">
                    <img id="main-thumbnail" src="{{Storage::url($product->photos()->latest()->first()->photo)}}" class="w-full h-full object-contain object-center" alt="thumbnail">
                </div>
                <div class="swiper w-full overflow-hidden">
                    <div class="swiper-wrapper">

                        @foreach ($product->photos as $itemPhoto)
                            <div class="swiper-slide !w-fit py-[2px]">
                            <label class="thumbnail-selector flex flex-col shrink-0 w-20 h-20 rounded-[20px] p-[10px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700] has-[:checked]:ring-2 has-[:checked]:ring-[#FFC700]">
                                <input type="radio" name="image" class="hidden">
                                <img src="{{Storage::url($itemPhoto->photo)}}" class="w-full h-full object-contain" alt="thumbnail">
                            </label>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
            <section id="info" class="flex flex-col gap-[14px] px-4">
                <div class="flex items-center justify-between">
                    <h1 id="title" class="font-bold text-2xl leading-9">{{$product->name}}</h1>
                    <div class="flex flex-col items-end shrink-0">
                        <div class="flex items-center gap-1">
                            <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[26px] h-[26px]" alt="star">
                            <span class="font-semibold text-xl leading-[30px]">4.5</span>
                        </div>
                        <p class="text-sm leading-[21px] text-[#878785]">(18,485 reviews)</p>
                    </div>
                </div>
                <p id="desc" class="leading-[30px]">{{$product->about}}.</p>
            </section>
            <div id="brand" class="flex items-center gap-4 px-4">
                <div class="w-[70px] h-[70px] rounded-[20px] bg-white overflow-hidden">
                    <img src="{{Storage::url($category->icon)}}" class="w-full h-full object-contain" alt="brand logo">
                </div>
                <div class="flex flex-col">
                    <h2 class="text-sm leading-[21px]">Kategori</h2>
                    <div class="flex items-center gap-1">
                        <h3 class="font-bold text-lg leading-[27px]">{{$category->name}}</h3>
                        <img src="{{asset('assets/images/icons/arrow-left.svg')}}" class="w-5 h-5" alt="icon">
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                        <p class="font-semibold">Quantity</p>
                        <div class="relative flex items-center gap-[30px]">
                            <button type="button" id='minus' class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#2A2A2A] overflow-hidden">
                                <span class="font-bold text-xl leading-[30px] text-white">-</span>
                            </button>
                            <p id="quantity-display" class="font-bold text-xl leading-[30px]">1</p>
                            <button type="button" id="plus" class="flex w-full h-[54px] items-center justify-center rounded-full bg-[#C5F277] overflow-hidden">
                                <span class="font-bold text-xl leading-[30px]">+</span>
                            </button>
                        </div>
                    </div>
            <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-3">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" name="quantity" id="quantity" value="1">
                <div id="form-bottom-nav" class="relative flex h-[100px] w-full shrink-0 mt-5">
                    <div class="fixed bottom-5 w-full max-w-[640px] z-30 px-4">
                        <div class="flex items-center justify-between rounded-full bg-[#2A2A2A] p-[10px] pl-6">
                            <div class="flex flex-col gap-[2px]">
                                <p class="font-bold text-[20px] leading-[30px] text-white">Rp <span id="subtotal" data-price="{{ $product->price }}">{{ number_format($product->price, 0, ',', '.') }}</span></p>
                            </div>
                            <button type="submit" class="rounded-full p-[12px_20px] bg-[#C5F277] font-bold">
                                Tambah Ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if (session('success'))
<div id="popup-cart"
    class="fixed bottom-10 left-1/2 -translate-x-1/2 bg-[#2A2A2A] text-white px-6 py-3 rounded-full shadow-lg animate-slide-up z-[999]">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        const popup = document.getElementById('popup-cart');
        if (popup) popup.style.display = 'none';
    }, 2000);
</script>

<style>
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translate(-50%, 20px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
    .animate-slide-up {
        animation: slideUp 0.3s ease-out;
    }
</style>
@endif


        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{asset('js/details.js')}}"></script>
        <script src="{{asset('js/booking.js')}}"></script>
    </body>
</html>