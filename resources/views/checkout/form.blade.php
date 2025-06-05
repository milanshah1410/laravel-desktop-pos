@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-4">🧾 Checkout</h1>

    <form method="POST" action="{{ route('checkout.process') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700">Customer Name</label>
            <input type="text" name="customer_name" required class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-gray-700">Email (optional)</label>
            <input type="email" name="customer_email" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Complete Order
            </button>
        </div>
    </form>
</div>
@endsection
