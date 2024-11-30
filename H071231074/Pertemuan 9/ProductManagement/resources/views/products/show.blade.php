@extends('layouts.app')

@section('content')
    <h2>Product Details</h2>

    <div class="mb-3">
        <strong>Product Name:</strong> {{ $product->name }}
    </div>
    <div class="mb-3">
        <strong>Category:</strong> {{ $product->category->name }}
    </div>
    <div class="mb-3">
        <strong>Price:</strong> {{ $product->price }}
    </div>
    <div class="mb-3">
        <strong>Stock:</strong> {{ $product->stock }}
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
@endsection
