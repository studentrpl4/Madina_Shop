<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 480px;
            margin: auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #222;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 15px;
            background: #fafafa;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:active {
            background: #0069d9;
        }

        .alert-success {
            background: #d4f7d4;
            color: #256b25;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .top-bar {
            text-align: center;
            padding: 15px 0;
            background: white;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

    </style>
    <link href="{{asset('output.css')}}" rel="stylesheet">
</head>
<body>
<div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
    <div class="top-bar">
        Profil Saya
    </div>

    <div class="container">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>Informasi Akun</h2>

            <form action="{{ route('customer.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <label>Email</label>
                <input type="email" value="{{ $customer->email }}" disabled>

                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" required>

                <label>Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" required>

                <label>Jenis Kelamin</label>
                <select name="gender" required>
                    <option value="laki-laki" {{ $customer->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ $customer->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <label>Tanggal Lahir</label>
                <input type="date" name="birth_date" 
                value="{{ old('birth_date', $customer->birth_date ? \Carbon\Carbon::parse($customer->birth_date)->format('Y-m-d') : '') }}"required>


                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>

    </div>
    <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0">
                <nav class="fixed bottom-5 w-full max-w-[640px] px-4 z-30">
                    <div class="grid grid-flow-col auto-cols-auto items-center justify-between rounded-full bg-[#2A2A2A] p-2 px-[30px]">
                        <a href="{{route('front.index')}}" class="active flex shrink-0 -mx-[22px]">
                            <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] bg-[#C5F277]">
                                <img src="{{asset('assets/images/icons/3dcube.svg')}}" class="w-6 h-6" alt="icon">
                                <span class="font-bold text-sm leading-[21px]">Browse</span>
                            </div>
                        </a>
                        <a href="{{route('cart.index')}}" class="mx-auto w-full">
                            <img src="{{asset('assets/images/icons/bag-2-white.svg')}}" class="w-6 h-6" alt="icon">
                        </a>
                        <a href="{{route('customer.orders')}}" class="mx-auto w-full">
                            <img src="{{asset('assets/images/icons/star-white.svg')}}" class="w-6 h-6" alt="icon">
                        </a>
                        <a href="{{route('customer.profile')}}" class="mx-auto w-full">
                            <img src="{{asset('assets/images/icons/24-support-white.svg')}}" class="w-6 h-6" alt="icon">
                        </a>
                    </div>
                </nav>
            </div>
</div>

</body>
</html>
