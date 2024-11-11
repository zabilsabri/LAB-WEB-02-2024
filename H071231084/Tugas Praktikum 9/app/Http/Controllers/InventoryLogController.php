<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::all();
        return view("inventorylogs.index", compact("logs"));
    }

    public function create()
    {
        $products = Product::all();
        return view("inventorylogs.create", compact("products"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);
                
                if ($request->type === 'sold' && $product->stock < $request->quantity) {
                    throw new \Exception('Stock is not enough.');
                }
                
                // Update product stock
                $product->stock += ($request->type === 'restock' ? $request->quantity : -$request->quantity);
                $product->save();
                
                // Create inventory log
                InventoryLog::create($request->all());
            });

            return redirect()->back()
                ->with('success', 'Stock successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function destroy(InventoryLog $inventorylog)
    {
        $inventorylog->delete();
        return redirect()->route('inventorylogs.index')->with('success', 'Product deleted successfully.');
    }

}