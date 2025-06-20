<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Alpine js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Icon --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <nav class="bg-[#131D4F] shadow px-4 py-3">
        <div class="container mx-auto flex justify-between items-center">

            <!-- Brand -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-white">
                JUALANY
            </a>

            <!-- Menu Kategori -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="/" class="text-white hover:text-gray-300 border-b-4 border-white">Properti</a>
                <a href="/" class="text-white hover:text-gray-300">Elektronik & Peralatan</a>
                <a href="/" class="text-white hover:text-gray-300">Jobs & Service</a>
                <a href="/" class="text-white hover:text-gray-300">Kendaraan</a>
                <a href="/" class="text-white hover:text-gray-300">Gaya Hidup</a>
                <a href="/" class="text-white hover:text-gray-300">Hiburan & Hobi</a>
                <a href="" class="text-white hover:text-gray-300">Pasang Iklan</a>
            </div>

            <!-- Icon & Daftar -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <a href="/search"
                    class="flex items-center justify-center w-9 h-9 border-2 border-white rounded-full hover:bg-white hover:text-[#131D4F] transition">
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path fill="currentColor"
                            d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                </a>

                <!-- Daftar -->
                <a href="/daftar"
                    class="px-4 py-1 border-2 border-white text-white rounded-full hover:bg-white hover:text-[#131D4F] transition">
                    Daftar
                </a>
            </div>
        </div>
    </nav>
    <div class="relative w-full h-[500px] overflow-hidden">

        <!-- Background image -->
        <div class="absolute inset-0 bg-center bg-fixed brightness-50"
            style="background-image: url('{{ asset('storage/bg-house.jpg') }}'); background-position: center; background-size: 1600px;">
        </div>

     
        <div class="relative z-10 max-w-6xl px-4 py-32 mx-auto text-white text-left">
            <h1 class="text-4xl font-bold leading-snug">
                Lorem ipsum dolor sit amet,<br>
                consectetur adipiscing elit, sed do eiusmod
            </h1>

            <div class="mt-8 bg-white p-4 rounded-xl inline-block">
                <p class="text-black text-sm font-semibold mb-4 text-left">Pilih Kategori Yang Diinginkan</p>
                <div class="flex gap-2">
                    <button class="bg-orange-400 text-white px-4 py-2 rounded-full font-semibold">Properti
                        Hunian</button>
                    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full font-semibold">Properti
                        Komersial</button>
                    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full font-semibold">Barang Mewah</button>
                </div>
            </div>
        </div>

        <!-- Main Slot Content -->
        <main class="container mx-auto flex-1 py-6 px-4">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-auto py-4">
            <div class="container mx-auto text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </footer>

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
