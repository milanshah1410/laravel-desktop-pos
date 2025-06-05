@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4">🛒 Cart</h2>

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

@if(count($cart) > 0)
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200 mb-6">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $item['name'] }}</td>
                    <td class="px-4 py-3">₹{{ number_format($item['price'], 2) }}</td>
                    <td class="px-4 py-3">{{ $item['qty'] }}</td>
                    <td class="px-4 py-3">₹{{ number_format($item['price'] * $item['qty'], 2) }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200">
                                🗑 Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-semibold mb-4">Total: ₹{{ number_format($total, 2) }}</h3>

    <div class="flex gap-4 mb-8">
        <form method="POST" action="{{ route('cart.clear') }}">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded hover:bg-yellow-200">
                ❌ Clear Cart
            </button>
        </form>

        <a href="{{ route('checkout.form') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition">
            💳 Proceed to Checkout
        </a>
    </div>
@else
    <p class="text-gray-600 mb-6">No items in cart.</p>
@endif

<hr class="my-6">

<h3 class="text-lg font-semibold mb-4">➕ Add Product to Cart</h3>
<form method="POST" action="{{ route('cart.add') }}" class="bg-white p-6 rounded shadow border border-gray-200 space-y-4 max-w-xl">
    @csrf

    <div>
        <label for="product_id" class="block font-medium text-gray-700 mb-1">Select Product</label>
        <select name="product_id" id="product_id" required
                class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
            @foreach(\App\Models\Product::all() as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (₹{{ number_format($product->price, 2) }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="qty" class="block font-medium text-gray-700 mb-1">Quantity</label>
        <input type="number" name="qty" id="qty" min="1" required
               class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-500" />
    </div>

    <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">
        ➕ Add to Cart
    </button>
</form>
@endsection
