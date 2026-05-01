<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price_general' => 'required|numeric',
            'price_member' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required',
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price_general' => $request->price_general,
            'price_member' => $request->price_member,
            'stock' => $request->stock,
            'sizes' => $request->sizes,
            'image_url' => $path,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // MENAMPILKAN FORM EDIT (Ini yang tadi error/hilang)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Memperbarui data produk dan stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price_member' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['sizes'] = $request->sizes ?? [];

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $data['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Kembali ke manajemen stok setelah update
        return redirect()->route('admin.products.index')->with('success', 'Stok dan data produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        $product->delete();
        
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}