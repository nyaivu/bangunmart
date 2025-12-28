<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BangunMart - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 font-sans text-slate-900">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-slate-300 shrink-0 flex flex-col">
            <div class="p-6 border-b border-slate-800">
                <h1 class="text-xl font-bold text-white tracking-tight">BangunMart</h1>
                <p class="text-xs text-slate-500 mt-1 uppercase">{{ auth()->user()->jabatan }} MODE</p>
            </div>
            
            <nav class="flex-1 p-4 space-y-1">
                <a href="/dashboard" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all {{ request()->is('dashboard') ? 'bg-blue-600 text-white' : '' }}">
                    Dashboard
                </a>

                @if(auth()->user()->jabatan == 'admin')
                    <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase">Master Data</div>
                    <a href="/produk" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Produk
                    </a>
                    <a href="/kategori" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Kategori
                    </a>
                    <a href="/satuan" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Satuan
                    </a>
                    <a href="/pelanggan" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Pelanggan
                    </a>
                    <a href="/supplier" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Supplier
                    </a>
                    
                    <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase">Laporan</div>
                    <a href="/laporan" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                        Laporan
                    </a>
                @endif

                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase">Transaksi</div>
                <a href="/penjualan/create" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all {{ request()->is('penjualan/create') ? 'bg-blue-600 text-white' : '' }}">
                    Transaksi Baru
                </a>
                <a href="/penjualan" class="flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                    Nota Penjualan
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center px-4 py-2 mb-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-3 text-sm">
                        {{ substr(auth()->user()->nama_pegawai, 0, 1) }}
                    </div>
                    <div class="text-sm">
                        <p class="text-white font-medium truncate">{{ auth()->user()->nama_pegawai }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-950/30 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>