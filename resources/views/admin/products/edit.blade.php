<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stok & Produk - Jihan Garment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:text-emerald-700 font-bold mb-8 inline-flex items-center gap-2 transition group">
            <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1"></i> 
            Batal & Kembali
        </a>

        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100">
            <div class="bg-[#2d4a3e] p-10 text-white relative overflow-hidden">
                <div class="relative z-10 text-center">
                    <h2 class="text-2xl font-black uppercase tracking-[0.2em] mb-2">Update Data Operasional</h2>
                    <p class="text-emerald-200/60 text-[10px] font-bold uppercase tracking-widest">Manajemen Stok & Inventaris Jihan Garment</p>
                </div>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-12 space-y-10">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold text-slate-700">
                    </div>

                    <!-- INPUT STOK (WARNA EMERALD AGAR JELAS) -->
                    <div>
                        <label class="block text-xs font-black text-emerald-600 uppercase mb-3 tracking-[0.2em]">Jumlah Stok Barang</label>
                        <div class="relative">
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full bg-emerald-50/30 border-2 border-emerald-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-black text-emerald-700 text-xl shadow-sm">
                            <i class="fa-solid fa-boxes-stacked absolute right-5 top-1/2 -translate-y-1/2 text-emerald-300"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Harga Member (Rp)</label>
                        <input type="number" name="price_member" value="{{ old('price_member', $product->price_member) }}" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Kategori</label>
                        <select name="category_id" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-emerald-500 outline-none transition font-bold text-slate-700">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Ganti Foto (Opsional)</label>
                        <input type="file" name="image" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-3 outline-none transition text-xs">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-4 tracking-[0.2em]">Update Ukuran Tersedia</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL', 'All Size'] as $size)
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" class="peer hidden" {{ in_array($size, $product->sizes ?? []) ? 'checked' : '' }}>
                                <div class="px-8 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-black text-slate-400 peer-checked:border-emerald-600 peer-checked:text-emerald-600 peer-checked:bg-emerald-50 transition-all flex items-center gap-2">
                                    {{ $size }}
                                    <i class="fa-solid fa-circle-check text-[10px] hidden peer-checked:block"></i>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Deskripsi Produk</label>
                        <textarea name="description" rows="4" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-3xl p-6 outline-none transition font-medium text-slate-600 shadow-sm">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#2d4a3e] hover:bg-slate-900 text-white font-black py-6 rounded-[2rem] shadow-2xl transition transform active:scale-[0.98] uppercase tracking-[0.3em] text-sm flex items-center justify-center gap-3">
                        <i class="fa-solid fa-rotate mr-2"></i> Update Stok & Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>