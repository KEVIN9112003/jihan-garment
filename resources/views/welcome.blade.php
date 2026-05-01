<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jihan Garment - Premium Apparel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        html { scroll-behavior: smooth; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(15px); }
        .bg-gradient-jihan { background: linear-gradient(135deg, #2d4a3e 0%, #1a2e26 100%); }
        .product-card:hover img { transform: scale(1.08); }
        .footer-shadow { box-shadow: 0 -20px 50px -20px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-[#fcfdfc] text-slate-900">

    <!-- MODERN NAVIGATION (BIGGER VERSION) -->
<nav class="glass-nav sticky top-0 z-50 border-b border-slate-100/50">
    <div class="container mx-auto px-8 py-6 flex items-center justify-between"> <!-- Padding py-6 lebih besar -->
        
        <!-- Logo Section -->
        <div class="flex items-center gap-6"> <!-- Gap lebih besar -->
            <div class="w-14 h-14 bg-gradient-jihan rounded-2xl flex items-center justify-center shadow-xl"> <!-- Kotak J lebih besar -->
                <span class="text-white font-bold text-2xl">J</span>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold tracking-tighter leading-none uppercase">JIHAN GARMENT</h1> <!-- Teks judul lebih besar -->
                <p class="text-xs font-bold text-emerald-700/60 tracking-[0.3em] uppercase mt-1">Premium Apparel</p>
            </div>
        </div>

        <!-- MENU DESKTOP (Tengah - Ukuran Lebih Besar) -->
        <div class="hidden md:flex items-center gap-14 text-xs font-black uppercase tracking-[0.25em] text-slate-500"> <!-- Text-xs & Gap lebih besar -->
            <a href="#produk" class="hover:text-emerald-600 transition-all hover:scale-110">Koleksi</a>
            <a href="#tentang" class="hover:text-emerald-600 transition-all hover:scale-110">Tentang Kami</a>
            <a href="#kontak" class="hover:text-emerald-600 transition-all hover:scale-110">Kontak</a>
        </div>

        <!-- ACTION SECTION (Cart & Login) -->
        <div class="flex items-center gap-6">
            <!-- FITUR CART (Lebih Besar) -->
            <a href="{{ route('cart.index') }}" class="relative p-4 bg-slate-50 text-slate-600 rounded-2xl hover:bg-emerald-50 hover:text-emerald-600 transition shadow-md border border-slate-100">
                <i class="fa-solid fa-bag-shopping text-2xl"></i> <!-- Icon lebih besar -->
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-2 -right-2 bg-emerald-600 text-white text-[10px] font-black w-6 h-6 rounded-xl flex items-center justify-center shadow-lg border-2 border-white">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

            @guest
                <!-- TOMBOL LOGIN LEBIH BESAR -->
                <a href="{{ route('login') }}" class="bg-slate-900 text-white px-12 py-5 rounded-2xl font-black text-xs hover:bg-emerald-800 transition-all shadow-xl uppercase tracking-[0.2em] active:scale-95">
                    LOGIN
                </a>
            @else
                <div class="flex items-center gap-4 border-l-2 pl-6 border-slate-200">
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.products.index') }}" class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition shadow-md" title="Panel Manajemen Stok">
                            <i class="fa-solid fa-gauge-high text-xl"></i>
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-500 transition shadow-sm">
                            <i class="fa-solid fa-power-off text-xl"></i>
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</nav>

    <!-- HERO SECTION -->
<header class="container mx-auto px-6 pt-10">
    <div class="relative rounded-[3rem] overflow-hidden shadow-2xl min-h-[500px] flex items-center">
        
        <!-- Background Image dengan Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/gambar.png') }}" class="w-full h-full object-cover">
            <!-- Overlay Gelap agar teks terbaca -->
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full md:w-3/5 p-10 md:p-20 text-center md:text-left">
            <span class="inline-block px-4 py-1.5 bg-white/10 rounded-full text-emerald-100 text-[10px] font-bold uppercase tracking-[0.3em] mb-6 backdrop-blur-sm">
                Berkualitas & Terpercaya
            </span>
            <h2 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-8 tracking-tighter">
                Premium <br> Apparel 
                <span class="opacity-60 italic font-light">Experience.</span>
            </h2>
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <a href="#produk" class="bg-white text-emerald-900 font-bold px-10 py-4 rounded-2xl shadow-xl hover:bg-emerald-50 transition active:scale-95 text-xs uppercase tracking-widest">
                    Lihat Koleksi
                </a>
            </div>
        </div>
    </div>
</header>

    <!-- KATEGORI -->
    <section class="container mx-auto px-6 mt-24">
        <div class="mb-12">
            <p class="text-emerald-700/60 font-bold text-xs uppercase tracking-[0.4em] mb-2">Kategori</p>
            <h3 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Pilih Produk Anda</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center text-[10px] font-black tracking-widest">
            <a href="{{ route('home') }}" class="group bg-white p-6 rounded-[2rem] border border-slate-100 flex flex-col items-center transition-all hover:shadow-xl {{ !request('category') ? 'ring-2 ring-emerald-600 bg-emerald-50/50' : '' }}">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-2xl text-slate-400 group-hover:bg-emerald-700 group-hover:text-white transition-all">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <span class="mt-4 text-slate-600 group-hover:text-emerald-800">SEMUA</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}" class="group bg-white p-6 rounded-[2rem] border border-slate-100 flex flex-col items-center transition-all hover:shadow-xl {{ request('category') == $cat->slug ? 'ring-2 ring-emerald-600 bg-emerald-50/50' : '' }}">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-2xl text-slate-400 group-hover:bg-emerald-700 group-hover:text-white transition-all uppercase">
                        @if($cat->slug == 'kaus') <i class="fa-solid fa-shirt"></i>
                        @elseif($cat->slug == 'jaket') <i class="fa-solid fa-user-ninja"></i>
                        @elseif($cat->slug == 'tas') <i class="fa-solid fa-briefcase"></i>
                        @elseif($cat->slug == 'topi') <i class="fa-solid fa-graduation-cap"></i>
                        @else <i class="fa-solid fa-tag"></i>
                        @endif
                    </div>
                    <span class="mt-4 text-slate-600 group-hover:text-emerald-800 uppercase">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- KOLEKSI PRODUK -->
    <section id="produk" class="container mx-auto px-6 mt-32">
        <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tighter mb-16 uppercase">Koleksi <span class="text-emerald-700">Unggulan</span></h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($products as $p)
            <div class="product-card group bg-white rounded-[3rem] p-5 transition-all duration-500 hover:shadow-2xl border border-slate-100 relative overflow-hidden flex flex-col">
                <div class="relative h-[400px] rounded-[2.5rem] overflow-hidden bg-[#f9faf9] flex items-center justify-center">
                    <img src="{{ asset('storage/' . $p->image_url) }}" class="w-full h-full object-contain p-6 transition-transform duration-700" onerror="this.src='https://via.placeholder.com/600x800'">
                    @if($p->stock <= 0)
                        <div class="absolute inset-0 bg-slate-900/60 flex items-center justify-center backdrop-blur-[2px]">
                            <span class="bg-white text-slate-900 px-6 py-2 rounded-full font-black text-[10px] uppercase tracking-widest">Habis Terjual</span>
                        </div>
                    @endif
                </div>
                
                <div class="mt-8 px-4 pb-4 flex-grow">
                    <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-[0.3em] mb-1">{{ $p->category->name }}</p>
                    <h4 class="text-2xl font-extrabold text-slate-800 tracking-tight uppercase leading-tight mb-6">{{ $p->name }}</h4>

                    <!-- FORM PEMILIHAN SIZE -->
                    <form action="{{ route('cart.add', $p->id) }}" method="POST">
                        @csrf
                        <div class="mb-8">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-3 italic">Ukuran Tersedia:</p>
                            <div class="flex flex-wrap gap-2">
                                @if($p->sizes && count($p->sizes) > 0)
                                    @foreach($p->sizes as $size)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="size" value="{{ $size }}" class="hidden peer" required>
                                            <span class="px-4 py-2 border border-slate-100 bg-slate-50 rounded-xl text-[9px] font-black text-slate-400 uppercase peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-600 transition-all block">
                                                {{ $size }}
                                            </span>
                                        </label>
                                    @endforeach
                                @else
                                    <input type="hidden" name="size" value="All Size">
                                    <span class="px-4 py-2 border border-slate-100 bg-slate-50 rounded-xl text-[9px] font-black text-slate-400 uppercase">All Size</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-slate-50 pt-6 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mb-1">Harga Anggota</span>
                                <span class="text-3xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($p->price_member, 0, ',', '.') }}</span>
                            </div>
                            @if($p->stock > 0)
                                <button type="submit" class="w-16 h-16 bg-slate-900 text-white rounded-[1.5rem] flex items-center justify-center shadow-xl hover:bg-emerald-700 hover:scale-110 transition-all">
                                    <i class="fa-solid fa-plus text-xl"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-400 font-bold uppercase tracking-widest">Produk tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- SECTION TENTANG KAMI & KONTAK (DIKEMBALIKAN) -->
    <section id="tentang" class="container mx-auto px-6 mt-40">
        <div class="bg-white rounded-[4rem] p-12 md:p-24 border border-slate-100 flex flex-col md:flex-row gap-20 items-center">
            <div class="md:w-1/2">
                <p class="text-emerald-600 font-bold text-xs uppercase tracking-[0.4em] mb-6">Filosofi Kami</p>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase mb-8 leading-none">Mengapa Jihan <br> Garment?</h3>
                <p class="text-slate-500 leading-relaxed font-medium mb-8">
                    Setiap jahitan menceritakan dedikasi kami terhadap kualitas. Kami hadir untuk memenuhi kebutuhan apparel premium dengan standar garment tertinggi di Indonesia. Fokus kami adalah kenyamanan Anda dan daya tahan produk yang tak tertandingi.
                </p>
            </div>
            <div class="md:w-1/2" id="kontak">
                <div class="bg-slate-50 rounded-[3rem] p-10 md:p-16 border border-slate-100">
                    <h4 class="text-xl font-black uppercase tracking-tighter mb-8 text-slate-800">Hubungi Kami</h4>
                    <div class="space-y-6">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-slate-100">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">Email Support</p>
                                <p class="font-bold text-slate-800 text-sm">support@jihangarment.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-slate-100">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">Warehouse Utama</p>
                                <p class="font-bold text-slate-800 text-sm">Jakarta Barat,no50b</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="mt-40 bg-slate-900 text-white py-16 footer-shadow">
        <div class="container mx-auto px-6 text-center">
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.5em]">
                &copy; 2026 Jihan Garment. Premium Apparel Experience.
            </p>
        </div>
    </footer>
</body>
</html>