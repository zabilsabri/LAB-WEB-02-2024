<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() // Menampilkan daftar semua produk
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()  // Menampilkan form untuk membuat produk baru
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request) // Menyimpan produk baru ke database
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show(Product $product) // Menampilkan detail produk tertentu
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product) // Menampilkan form edit untuk produk tertentu
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) // Memperbarui produk tertentu di database
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) // Menghapus produk tertentu dari database
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
?>
