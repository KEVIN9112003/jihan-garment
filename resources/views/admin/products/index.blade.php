<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Jihan Garment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 min-h-screen">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm mb-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-600 hover:text-emerald-600 transition font-bold text-sm uppercase tracking-widest">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
                <span class="text-slate-300">|</span>
                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Panel Operasional</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right text-xs uppercase tracking-widest font-black">
                    <p class="text-slate-400 leading-none">Administrator</p>
                    <p class="text-slate-800 italic">{{ Auth::user()->name }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-xl transition font-bold text-xs uppercase flex items-center gap-2">
                        <i class="fa-solid fa-power-off"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6">
        <!-- NOTIFIKASI SUKSES -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-xl p-10 border border-slate-200/60">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tighter uppercase">Manajemen <span class="text-emerald-600">Stok</span></h2>
                <a href="{{ route('admin.products.create') }}" class="bg-[#2d4a3e] hover:bg-slate-900 text-white font-bold px-8 py-4 rounded-2xl transition shadow-lg flex items-center gap-2 uppercase text-xs tracking-widest">
                    <i class="fa-solid fa-plus"></i> Tambah Barang
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">
                            <th class="px-6 py-4">Info Produk</th>
                            <th class="px-6 py-4 text-center">Status Stok</th>
                            <th class="px-6 py-4 text-center">Ukuran</th>
                            <th class="px-6 py-4 text-center">Harga Member</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="bg-slate-50/50 hover:bg-slate-50 transition rounded-3xl">
                            <td class="px-6 py-4 rounded-l-3xl">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $product->image_url) }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" onerror="this.src='https://via.placeholder.com/100'">
                                    <span class="font-bold text-slate-700 uppercase text-xs">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($product->stock <= 0)
                                    <span class="bg-slate-100 text-slate-500 text-[9px] font-black px-3 py-1 rounded-lg border border-slate-200 uppercase tracking-widest italic">Habis</span>
                                @elseif($product->stock <= 5)
                                    <span class="bg-red-50 text-red-600 text-[9px] font-black px-3 py-1 rounded-lg border border-red-100 uppercase tracking-widest italic">Low: {{ $product->stock }}</span>
                                @else
                                    <span class="bg-emerald-50 text-emerald-600 text-[9px] font-black px-3 py-1 rounded-lg border border-emerald-100 uppercase tracking-widest italic">Ready: {{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center font-black text-[8px] uppercase">
                                <div class="flex flex-wrap justify-center gap-1">
                                    @foreach($product->sizes ?? [] as $size)
                                        <span class="bg-white border border-slate-200 px-1.5 py-0.5 rounded text-slate-400">{{ $size }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-black tracking-tighter text-sm">
                                <span class="text-emerald-700">Rp {{ number_format($product->price_member, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right rounded-r-3xl">
                                <div class="flex items-center justify-end gap-3 text-lg">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-emerald-600 hover:scale-110 transition"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:scale-110 transition" onclick="return confirm('Hapus produk?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FOOTER (TENTANG KAMI) -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-slate-200 pt-12 pb-20">
            <div>
                <h3 class="text-emerald-600 font-black uppercase tracking-widest text-sm mb-6">Tentang Jihan Garment</h3>
                <p class="text-slate-500 text-xs leading-relaxed font-medium">
                    Penyedia apparel premium dengan fokus pada kualitas bahan dan kepuasan pelanggan. 
                    Panel operasional ini digunakan khusus untuk manajemen stok gudang secara real-time.
                </p>
            </div>
            <div>
                <h3 class="text-slate-800 font-black uppercase tracking-widest text-sm mb-6">Kontak & Bantuan</h3>
                <ul class="text-slate-500 text-xs space-y-3 font-medium">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-emerald-500"></i> admin@jihangarment.com</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-phone text-emerald-500"></i> +62 812-3456-7890</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-emerald-500"></i> Gudang Utama, Bandung</li>
                </ul>
            </div>
            <div class="bg-[#2d4a3e] p-8 rounded-[2rem] text-white relative overflow-hidden">
                <h3 class="text-xs font-black uppercase tracking-widest mb-4 relative z-10">Status Sistem</h3>
                <div class="flex items-center gap-3 relative z-10">
                    <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-200">Server Aktif & Optimal</span>
                </div>
                <i class="fa-solid fa-shield-halved absolute -right-4 -bottom-4 text-white/5 text-8xl"></i>
            </div>
        </div>
    </div>

    <!-- COPYRIGHT BAR -->
    <footer class="bg-slate-900 py-8">
        <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em]">
            © 2026 Jihan Garment. Premium Apparel Experience.
        </p>
    </footer>

</body>
</html>