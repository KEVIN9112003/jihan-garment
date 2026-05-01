<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <nav class="bg-white py-6 shadow-sm">
        <div class="container mx-auto px-6">
            <a href="{{ route('home') }}" class="text-green-700 font-bold"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>
    </nav>

    <div class="container mx-auto px-6 mt-12">
        <div class="flex flex-col md:flex-row bg-white rounded-[3rem] shadow-2xl overflow-hidden">
            <div class="md:w-1/2">
                <img src="{{ $product->image_url }}" class="w-full h-[500px] object-cover">
            </div>
            <div class="md:w-1/2 p-12 flex flex-col justify-center">
                <span class="text-green-600 font-bold tracking-widest uppercase">{{ $product->category->name }}</span>
                <h1 class="text-5xl font-black text-slate-800 mt-4 leading-tight">{{ $product->name }}</h1>
                <p class="mt-8 text-slate-500 text-lg leading-relaxed">{{ $product->description }}</p>
                
                <div class="mt-10 p-8 bg-green-50 rounded-[2rem]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-800 font-bold">Harga Khusus Anggota</p>
                            <p class="text-4xl font-black text-green-700 mt-1">Rp {{ number_format($product->price_member, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-400 line-through">Rp {{ number_format($product->price_general, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full mt-10 bg-green-700 text-white font-bold py-5 rounded-[1.5rem] text-xl shadow-xl hover:bg-green-800 transition transform active:scale-95">
                        <i class="fa-solid fa-cart-shopping mr-3"></i> MASUKKAN KERANJANG
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>