@extends('layout.app')

@section('title', 'Login')

@section('content')

    <div class="min-h-screen flex flex-col items-center pt-10">

        {{-- Login Box --}}
        <div class="w-full max-w-md px-3">

            <h2 class="text-3xl font-bold text-gray-800">Setup Profile</h2>
            <p class="text-secondary-text text-sm mt-1 mb-6">Silahkan data anda</p>

            {{-- Username --}}
            <form action="{{ route('customer.setupProfile') }}" method="POST">
                @csrf
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama lenggkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none"
                    placeholder="Masukkan nama anda">

                {{-- Password --}}
                <label for="phone" class="block text-sm font-semibold text-gray-700 mt-3 mb-1">Nomer Telepon</label>
                <div class="relative">
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none"
                        placeholder="Masukkan nomer anda">

                </div>
                <label for="gender" class="block text-sm font-semibold text-gray-700 mt-3 mb-1">Jenis Kelamin</label>
                <div class="relative">
                    <select name="gender" id="gender" required
                        class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none">
                        <option value="">-- Pilih --</option>
                        <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <label for="birth_date" class="block text-sm font-semibold text-gray-700 mt-3 mb-1">Tanggal Lahir</label>
                <div class="relative">
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                        class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none"
                        placeholder="Masukkan password anda">

                </div>

                {{-- Forget --}}
                <div class="text-right mt-2 mb-5">
                    {{-- <a href="#" class="text-secondary-text text-sm hover:text-primary-green">Lupa Password?</a> --}}
                </div>

                {{-- Login Button --}}
                <button id="loginBtn" type="submit"
                    class="w-full py-3 bg-gray-300 text-white rounded-full text-lg font-medium cursor-not-allowed">
                    Simpan dan Lanjutkan
                </button>
            </form>
            {{-- Register --}}
            {{-- <p class="text-center mt-4 text-secondary-text text-sm">
                Sudah punya akun?
                <a href="{{ route('customer.auth.login') }}" class="text-[#0AA085] font-semibold">Login</a>
            </p> --}}
        </div>

    </div>
    <script>
        const username = document.getElementById("name");
        const password = document.getElementById("phone");
        // const password = document.getElementById("gender");
        const password = document.getElementById("birth_date");
        const loginBtn = document.getElementById("loginBtn");

        function toggleButton() {
            if (username.value.trim() !== "" && password.value.trim() !== "") {
                loginBtn.classList.remove("bg-gray-300", "cursor-not-allowed");
                loginBtn.classList.add("bg-[#0AA085]", "cursor-pointer");
            } else {
                loginBtn.classList.add("bg-gray-300", "cursor-not-allowed");
                loginBtn.classList.remove("bg-[#0AA085]", "cursor-pointer");
            }
        }

        username.addEventListener("input", toggleButton);
        password.addEventListener("input", toggleButton);
    </script>
@endsection