@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">🧾 Sales for {{ $customer->name }} ({{ $customer->mobile }})</h2>

@forelse($customer->sales as $sale)
    <div class="mb-6 border rounded shadow-sm p-4 bg-white">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h3 class="font-semibold text-lg">Invoice #{{ $sale->id }}</h3>
                <p class="text-sm text-gray-600">
                    {{ $sale->created_at->format('d M Y h:i A') }}
                </p>
            </div>
            <a href="{{ route('sales.invoice.pdf', $sale->id) }}"
               class="text-blue-600 hover:underline text-sm">
               📄 Download PDF
            </a>
        </div>

        <p class="mb-2 text-sm">
            <strong>Total:</strong> ₹{{ $sale->total }} &nbsp;|&nbsp;
            <strong>Paid:</strong> ₹{{ $sale->paid }}
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Product</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Qty</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Price</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->items as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $item->product->name }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">₹{{ $item->unit_price }}</td>
                            <td class="px-4 py-2">₹{{ $item->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@empty
    <p class="text-gray-500">No sales found for this customer.</p>
@endforelse
@endsection
