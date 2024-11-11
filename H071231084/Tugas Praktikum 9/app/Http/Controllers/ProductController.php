<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryLog;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $products = Product::all();   
        return view("products.index", compact("products"));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.create', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::create($request->all());
            
            InventoryLog::create([
                'product_id' => $product->id,
                'type' => 'Restock',
                'quantity' => $request->stock
            ]);
        });

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dibuat.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    

    public function edit(Product $product)
    {
        // $products = Product::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());
        // $product->category()->sync($request->category_ids); 
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}