@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-6">💳 Checkout</h2>

@if(count($cart) === 0)
    <p class="text-gray-600">Your cart is empty.</p>
@else
    <div class="overflow-x-auto mb-6 bg-white rounded shadow border border-gray-200">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-700">Product</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Qty</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Price</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $item['name'] }}</td>
                    <td class="px-4 py-3">{{ $item['qty'] }}</td>
                    <td class="px-4 py-3">₹{{ number_format($item['price'], 2) }}</td>
                    <td class="px-4 py-3">₹{{ number_format($item['qty'] * $item['price'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 class="text-lg font-semibold mb-4">Subtotal: ₹{{ number_format($total, 2) }}</h3>

    <form method="POST" action="{{ route('checkout.process') }}" class="max-w-md space-y-4 bg-white p-6 rounded shadow border border-gray-200">
        @csrf

        <h3 class="text-xl font-semibold mb-4">Customer Info</h3>

        <div>
            <label for="name" class="block mb-1 font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="mobile" class="block mb-1 font-medium text-gray-700">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('mobile')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="discount" class="block mb-1 font-medium text-gray-700">Discount ₹</label>
            <input type="number" step="0.01" name="discount" id="discount" value="0"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('discount')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="paid" class="block mb-1 font-medium text-gray-700">Paid ₹</label>
            <input type="number" step="0.01" name="paid" id="paid" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('paid')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" 
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">
            ✅ Complete Payment
        </button>
    </form>
@endif
@endsection
