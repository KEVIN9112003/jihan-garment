<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->get();
        return view('welcome', compact('categories', 'products'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('product-detail', compact('product'));
    }

    public function cart() 
    { 
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart', compact('total')); 
    }

    public function addToCart(Request $request, $id) // MENAMBAHKAN Request $request
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok produk ini sedang habis!');
        }

        $cart = session()->get('cart', []);
        $price = Auth::check() ? $product->price_member : $product->price_general;
        
        // FUNGSI BARU: Ambil input size dan buat cart unik per ukuran
        $size = $request->input('size', 'All Size');
        $cartKey = $id . '-' . $size;

        if(isset($cart[$cartKey])) {
            if ($cart[$cartKey]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia!');
            }
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $price,
                "image" => $product->image_url,
                "size" => $size // SIMPAN UKURAN
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function removeFromCart($id) 
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong!');
        }
        $total = 0;
        foreach ($cart as $item) { $total += $item['price'] * $item['quantity']; }
        return view('checkout', compact('total', 'cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate(['payment_method' => 'required']);
        $cart = session()->get('cart');
        foreach ($cart as $key => $details) {
            $productId = explode('-', $key)[0];
            $product = Product::find($productId);
            if ($product) { $product->decrement('stock', $details['quantity']); }
        }
        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Pesanan Jihan Garment berhasil dibuat!');
    }

    // AUTH FUNCTIONS TETAP SAMA
    public function showLogin() { return view('login'); }
    public function login(Request $request) {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') { return redirect()->route('admin.products.index'); }
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function showRegister() { return view('register'); }
    public function register(Request $request) {
        $request->validate(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|confirmed']);
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'role' => 'customer']);
        Auth::login($user);
        return redirect('/')->with('success', 'Selamat datang!');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}