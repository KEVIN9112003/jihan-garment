<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Koperasi Sejahtera</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-700 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10">
        <h1 class="text-3xl font-black text-slate-800 text-center uppercase">Daftar Akun</h1>
        <form action="{{ route('register') }}" method="POST" class="mt-8 space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 outline-none focus:border-green-500 transition">
            <input type="email" name="email" placeholder="Email" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 outline-none focus:border-green-500 transition">
            <input type="password" name="password" placeholder="Password (Min 8 Karakter)" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 outline-none focus:border-green-500 transition">
            <input type="password" name="password_confirmation" placeholder="Ulangi Password" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 outline-none focus:border-green-500 transition">
            <button type="submit" class="w-full bg-green-600 text-white font-black py-5 rounded-2xl shadow-xl hover:bg-green-700 transition">DAFTAR SEKARANG</button>
        </form>
        <p class="mt-6 text-center text-slate-400 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 font-bold">Login</a></p>
    </div>
</body>
</html>