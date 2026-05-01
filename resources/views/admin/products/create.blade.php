<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru - Jihan Garment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 py-12">
    <div class="max-w-3xl mx-auto px-6">
        <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:text-emerald-700 font-bold mb-6 inline-block transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Panel Admin
        </a>

        <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
            <div class="bg-[#2d4a3e] p-8 text-white">
                <h2 class="text-2xl font-bold uppercase tracking-widest text-center">Form Tambah Barang</h2>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Nama Barang</label>
                        <input type="text" name="name" required placeholder="Contoh: Kemeja Flanel Premium" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Kategori</label>
                        <select name="category_id" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold text-slate-700">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Foto Produk</label>
                        <input type="file" name="image" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-3 focus:border-emerald-500 outline-none transition text-sm">
                    </div>

                    <!-- INPUT STOK (BARU DI CREATE) -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-emerald-600 uppercase mb-2 tracking-widest">Jumlah Stok Awal</label>
                        <div class="relative">
                            <input type="number" name="stock" value="0" required class="w-full bg-emerald-50/30 border-2 border-emerald-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-black text-emerald-700 text-lg">
                            <i class="fa-solid fa-boxes-stacked absolute right-5 top-1/2 -translate-y-1/2 text-emerald-300"></i>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-4 tracking-widest">Ukuran Tersedia</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL', 'All Size'] as $size)
                            <label class="relative cursor-pointer group">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" class="peer hidden">
                                <div class="px-6 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-400 peer-checked:border-emerald-600 peer-checked:text-emerald-600 peer-checked:bg-emerald-50 transition-all flex items-center gap-2">
                                    {{ $size }}
                                    <i class="fa-solid fa-check text-[10px] hidden peer-checked:block"></i>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Harga Umum</label>
                        <input type="number" name="price_general" required placeholder="Rp 0" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Harga Anggota</label>
                        <input type="number" name="price_member" required placeholder="Rp 0" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold text-emerald-700">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Deskripsi</label>
                    <textarea name="description" rows="4" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#2d4a3e] hover:bg-slate-900 text-white font-black py-5 rounded-2xl shadow-xl transition transform active:scale-95 uppercase tracking-widest text-lg">
                    Simpan ke Katalog
                </button>
            </form>
        </div>
    </div>
</body>
</html>