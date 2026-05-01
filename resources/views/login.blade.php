<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Koperasi Sejahtera</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-700 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10">
        <h1 class="text-3xl font-black text-slate-800 text-center uppercase tracking-tighter">
            Masuk <span class="text-green-600 font-light">Akun</span>
        </h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-2xl mt-6 text-sm font-bold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-5">
            @csrf
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
                <input type="email" name="email" required 
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-green-500 outline-none transition"
                    placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 focus:border-green-500 outline-none transition"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl shadow-xl transition transform active:scale-95 uppercase tracking-widest">
                Login Sekarang
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-slate-400 text-sm">Belum punya akun anggota?</p>
            <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline mt-1 inline-block text-lg">
                Daftar Akun Baru
            </a>
        </div>

        <div class="text-center mt-4">
            <a href="/" class="text-slate-300 text-xs hover:text-slate-500 transition">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>