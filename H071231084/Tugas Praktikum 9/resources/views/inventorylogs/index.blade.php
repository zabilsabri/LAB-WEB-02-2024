@extends('layout.main')

@section('content')

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rou5ded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold mb-4">Inventory Logs</h1>

    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-5 border text-left">No.</th>
                <th class="py-2 px-5 border text-left">Name</th>
                <th class="py-2 px-5 border text-left">Description</th>
                <th class="py-2 px-5 border text-left">Category</th>
                <th class="py-2 px-5 border text-left">Type</th>
                <th class="py-2 px-5 border text-left">Quantity</th>
                <th class="py-2 px-5 border text-left">Timestamps</th>
                <th class="py-2 px-5 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-5 border">{{ $loop->iteration }}</td>
                    <td class="py-2 px-5 border">{{ $log->product->name }}</a></td>
                    <td class="py-2 px-5 border">{{ $log->product->description }}</td>
                    <td class="py-2 px-5 border">{{ $log->product->category->name }}</td>
                    <td class="py-2 px-5 border">{{ $log->type }}</td>
                    <td class="py-2 px-5 border">{{ $log->quantity }}</td>
                    <td class="py-2 px-5 border">{{ $log->created_at->format('d-m-Y H:i:s') }} </td>
                    <td class="py-2 px-5 border text-center">
                        <form action="{{ route('inventorylogs.destroy',['inventorylog' => $log->id]) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection