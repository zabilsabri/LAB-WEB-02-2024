@extends('layout.main')

@section('content')

@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4" role="alert">
    {{ session('success') }}
</div>
@endif
    <div class="fluid-container mx-auto px-4">
        <!-- Product Header Section -->
        <div class="bg-white rounded-lg shadow-md p-8 my-5">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                    <p class="text-gray-600 text-lg mb-4">{{ $product->description }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-green-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <div class="flex items-center justify-end">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <div
                                class="w-2 h-2 rounded-full p-2 {{ $product->stock > 10 ? 'bg-green-500' : 'bg-red-500' }} mr-2">
                            </div>
                            {{ $product->stock }} units in stock
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Management Section -->
        <div class="grid md:grid-cols-5 gap-5">
            <!-- Update Stock Form -->
            <div class="col-span-2 bg-white rounded-lg shadow-md">
                <div class="border-b px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Update Stock</h2>
                </div>
                <form action="{{ route('inventorylogs.store', $product->id) }}" method="POST" class="p-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Stock Change Type</label>
                        <div class="relative">
                            <select name="type" id="type" required
                                class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                                <option value="restock">Restock Inventory</option>
                                <option value="sold">Record Sale</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <input type="number" name="quantity" id="quantity" min="1" required
                                class="block w-full pl-3 pr-12 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md"
                                placeholder="Enter quantity">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm">units</span>
                            </div>
                        </div>
                    </div>

                    <!-- Display Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Update Stock
                        </button>
                    </div>
                </form>
            </div>

            <!-- Stock History Table -->
            <div class="col-span-3 bg-white rounded-lg shadow-md">
                <div class="border-b px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Stock History</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Time</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($product->inventoryLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $log->type === 'restock' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($log->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection