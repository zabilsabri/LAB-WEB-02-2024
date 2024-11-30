<?php
namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function store(Request $request, Product $product) // Menambahkan catatan perubahan stok untuk produk tertentu
    {
        $request->validate([
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
        ]);

        // Buat log perubahan stok
        InventoryLog::create([
            'product_id' => $product->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
        ]);

        if ($request->type === 'restock') { // Sesuaikan stok produk berdasarkan jenis perubahan
            $product->stock += $request->quantity;
        } else if ($request->type === 'sold') {
            $product->stock -= $request->quantity;
        }
        $product->save();

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Inventory log added successfully.');
    }

    public function destroy($id) // Menghapus catatan perubahan stok tertentu
    {
        $inventoryLog = InventoryLog::findOrFail($id);
        $product = $inventoryLog->product;

        if ($inventoryLog->type === 'restock') { // Sesuaikan stok produk berdasarkan jenis perubahan yang dihapus
            $product->stock -= $inventoryLog->quantity;
        } else if ($inventoryLog->type === 'sold') {
            $product->stock += $inventoryLog->quantity;
        }
        $product->save();

        $inventoryLog->delete();

        return redirect()->route('products.show', $product->id)
                         ->with('success', 'Inventory log deleted successfully.');
    }
}
?>
