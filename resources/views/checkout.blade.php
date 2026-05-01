<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Koperasi Jihan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="container mx-auto px-6 py-12 max-w-5xl">
        <h1 class="text-4xl font-black text-slate-800 mb-10 tracking-tighter uppercase">Metode <span class="text-green-600">Pembayaran</span></h1>
        
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-2/3">
                <form action="{{ route('checkout.process') }}" method="POST" id="form-pembayaran" class="space-y-4">
                    @csrf
                    
                    <label class="block group cursor-pointer">
                        <input type="radio" name="payment_method" value="transfer" class="hidden peer" checked>
                        <div class="p-8 bg-white border-2 border-slate-100 rounded-[2rem] peer-checked:border-green-500 peer-checked:bg-green-50 transition-all shadow-sm">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600">
                                        <i class="fa-solid fa-university text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-lg">Transfer Bank Manual</p>
                                        <p class="text-sm text-slate-500">Kirim ke Rekening BCA: 1234-567-890</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-circle-check text-green-500 text-2xl opacity-0 peer-checked:opacity-100"></i>
                            </div>
                        </div>
                    </label>

                    <label class="block group cursor-pointer">
                        <input type="radio" name="payment_method" value="potong_gaji" class="hidden peer">
                        <div class="p-8 bg-white border-2 border-slate-100 rounded-[2rem] peer-checked:border-green-500 peer-checked:bg-green-50 transition-all shadow-sm">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-600">
                                        <i class="fa-solid fa-file-invoice-dollar text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-lg">Sistem Potong Gaji</p>
                                        <p class="text-sm text-slate-500">Otomatis dipotong dari saldo Koperasi Jihan</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-circle-check text-green-500 text-2xl opacity-0 peer-checked:opacity-100"></i>
                            </div>
                        </div>
                    </label>
                </form>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl border border-slate-50">
                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Total Tagihan</h3>
                    <div class="text-4xl font-black text-green-700 mb-10">Rp {{ number_format($total, 0, ',', '.') }}</div>
                    
                    <button type="submit" form="form-pembayaran" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl shadow-xl transition transform active:scale-95 uppercase tracking-widest">
                        Konfirmasi & Bayar
                    </button>

                    <p class="text-center text-xs text-slate-400 mt-6 italic">
                        *Dengan mengklik tombol, Anda menyetujui syarat & ketentuan Koperasi Jihan.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>