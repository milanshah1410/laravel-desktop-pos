@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">🧾 Invoice</h2>

<div class="bg-white rounded shadow border border-gray-200 p-6 mb-6">
    <p class="text-sm text-gray-600">Sale ID: <strong>#{{ $sale->id }}</strong></p>
    <p class="text-sm text-gray-600 mb-4">Date: <strong>{{ $sale->created_at->format('d M Y h:i A') }}</strong></p>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-300">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b">Product</th>
                    <th class="px-4 py-2 border-b">Qty</th>
                    <th class="px-4 py-2 border-b">Unit Price</th>
                    <th class="px-4 py-2 border-b">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $item->product->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->quantity }}</td>
                        <td class="px-4 py-2 border-b">₹{{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-4 py-2 border-b">₹{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 space-y-2 text-gray-800">
        <p><strong>Subtotal:</strong> ₹{{ number_format($sale->subtotal, 2) }}</p>
        <p><strong>Discount:</strong> ₹{{ number_format($sale->discount, 2) }}</p>
        <p><strong>Total:</strong> ₹{{ number_format($sale->total, 2) }}</p>
        <p><strong>Paid:</strong> ₹{{ number_format($sale->paid, 2) }}</p>
    </div>
</div>

<a href="{{ route('cart.index') }}"
   class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded transition">
    ← Back to POS
</a>
@endsection
