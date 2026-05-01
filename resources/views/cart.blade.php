<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Jihan Garment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen antialiased">
    <nav class="bg-white py-6 shadow-sm mb-10 sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-emerald-700 font-bold uppercase tracking-widest text-sm hover:text-emerald-800 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali Belanja
            </a>
            <span class="text-slate-400 font-bold text-xs uppercase tracking-widest italic">Jihan Garment</span>
        </div>
    </nav>

    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-black text-slate-800 mb-10 tracking-tighter uppercase">Keranjang <span class="text-emerald-600">Anda</span></h1>

        <div class="flex flex-col lg:flex-row gap-12 mb-20">
            <div class="lg:w-2/3 space-y-6">
                @if(session('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $id => $details)
                    <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center gap-6 hover:shadow-md transition">
                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-24 h-24 rounded-3xl object-cover shadow-inner" onerror="this.src='https://via.placeholder.com/150?text=Produk'">
                        <div class="flex-1">
                            <h3 class="font-bold text-xl text-slate-800 uppercase tracking-tight">{{ $details['name'] }}</h3>
                            <!-- TAMPILKAN SIZE DISINI -->
                            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-1">Ukuran: {{ $details['size'] ?? 'All Size' }}</p>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-emerald-700 font-black text-lg">Rp {{ number_format($details['price'], 0, ',', '.') }}</span>
                                <span class="text-slate-200">|</span>
                                <span class="text-slate-500 text-sm font-medium">Jumlah: {{ $details['quantity'] }}</span>
                            </div>
                        </div>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-12 h-12 bg-red-50 rounded-2xl text-red-400 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                @else
                    <div class="bg-white p-20 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-bold text-xl uppercase tracking-widest">Keranjang masih kosong</p>
                    </div>
                @endif
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-50 sticky top-28">
                    <h3 class="text-xl font-black text-slate-800 mb-6 uppercase tracking-widest">Ringkasan</h3>
                    @php 
                        $total = 0; $waText = "Halo Jihan Garment, saya memesan:%0A";
                        if(session('cart')){
                            foreach(session('cart') as $id => $details){
                                $total += $details['price'] * $details['quantity'];
                                $waText .= "- " . $details['name'] . " (" . ($details['size'] ?? 'All Size') . ") x" . $details['quantity'] . "%0A";
                            }
                            $waText .= "%0ATotal: Rp " . number_format($total, 0, ',', '.');
                        }
                    @endphp
                    <div class="space-y-4 border-b border-slate-100 pb-6 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500 font-medium uppercase tracking-wider">Subtotal</span>
                            <span class="font-bold text-slate-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-10">
                        <span class="font-bold text-slate-400 text-xs uppercase tracking-[0.2em]">Total Akhir</span>
                        <span class="text-3xl font-black text-emerald-700 leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block text-center w-full bg-slate-900 text-white font-black py-5 rounded-[1.5rem] shadow-xl hover:bg-slate-800 uppercase tracking-widest text-lg mb-4">Checkout Sekarang</a>
                    <a href="https://wa.me/6282234567890?text={{ $waText }}" target="_blank" class="block text-center w-full border-2 border-emerald-500 text-emerald-600 font-black py-4 rounded-[1.5rem] hover:bg-emerald-50 uppercase tracking-widest text-sm">
                        <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Beli via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>