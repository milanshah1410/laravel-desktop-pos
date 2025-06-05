@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded-lg">

    {{-- Heading --}}
    <h1 class="text-2xl font-bold mb-4 text-gray-800">📦 Product Management</h1>

    {{-- Add Product Form --}}
    <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @csrf
        <input type="text" name="name" placeholder="Product Name" required class="border p-2 rounded">
        <input type="text" name="sku" placeholder="SKU" required class="border p-2 rounded">
        <input type="number" name="price" step="0.01" placeholder="Price" required class="border p-2 rounded">
        <input type="number" name="stock" placeholder="Stock" required class="border p-2 rounded">
        <div class="col-span-full">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ➕ Add Product
            </button>
        </div>
    </form>

    {{-- Products Table --}}
    <div class="col-span-full float-right mb-4">
        <a href="{{ route('products.export') }}" class="text-green-600 hover:underline">📤 Export to Excel</a>
    </div>
    {{-- Search Form --}}
    <form method="GET" action="{{ route('products.index') }}" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search by name or SKU"
            class="border p-2 rounded w-full md:w-1/3">
    </form>
    <div class="overflow-x-auto bg-white rounded">
        <table class="min-w-full text-sm text-left border rounded">
            <thead class="bg-gray-100">
                <tr>
                    @php
                    $currentSort = request('sort');
                    $currentDirection = request('direction') === 'desc' ? 'asc' : 'desc';
                    @endphp

                    <th class="p-3">
                        <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $currentDirection])) }}">
                            Name
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'sku', 'direction' => $currentDirection])) }}">
                            SKU
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'price', 'direction' => $currentDirection])) }}">
                            Price
                        </a>
                    </th>
                    <th class="p-3">
                        <a href="{{ route('products.index', array_merge(request()->all(), ['sort' => 'stock', 'direction' => $currentDirection])) }}">
                            Stock
                        </a>
                    </th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-t">{{ $product->name }}</td>
                    <td class="p-3 border-t">{{ $product->sku }}</td>
                    <td class="p-3 border-t">₹{{ number_format($product->price, 2) }}</td>
                    <td class="p-3 border-t">{{ $product->stock }}</td>
                    <td class="p-3 text-center border-t">
                        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 p-4">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection