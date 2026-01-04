@extends('layout.app')

@section('title', 'Login')

@section('content')
    <header class="flex items-center mb-20">
        <div class="p-2 bg-primary-green/20 rounded-lg mr-3">
            <svg class="w-6 h-6 text-[#0AA085]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
        <h1 class="text-xl font-semibold text-gray-800">Madinashop</h1>
    </header>
    <div class="min-h-screen flex flex-col items-center pt-10">

        {{-- Login Box --}}
        <div class="w-full max-w-md px-3">

            <h2 class="text-3xl font-bold text-gray-800">Resigtrasi</h2>
            <p class="text-secondary-text text-sm mt-1 mb-6">Silahkan buat akun anda dengan masukan email</p>

            {{-- Username --}}
            <form action="{{ route('customer.auth.register') }}" method="POST">
                @csrf
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input type="email" id="email" name="email"
                    class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none"
                    placeholder="Masukkan email anda">

                {{-- Password --}}
                <label for="password" class="block text-sm font-semibold text-gray-700 mt-3 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full bg-white rounded-full py-3 px-5 text-gray-700 shadow-sm border border-gray-200 focus:ring-primary-green focus:ring-2 outline-none"
                        placeholder="Masukkan password anda">

                </div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mt-3 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password_confirmation"
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
                    Register
                </button>
            </form>
            {{-- Register --}}
            <p class="text-center mt-4 text-secondary-text text-sm">
                Sudah punya akun?
                <a href="{{ route('customer.auth.login') }}" class="text-[#0AA085] font-semibold">Login</a>
            </p>
        </div>

    </div>
    <script>
        const username = document.getElementById("email");
        const password = document.getElementById("password");
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