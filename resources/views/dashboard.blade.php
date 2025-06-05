@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-6">📊 POS Dashboard</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <a href="{{ route('products.index') }}" class="bg-white hover:bg-blue-50 border rounded-xl p-5 shadow flex items-center space-x-3">
                <span class="text-2xl">📦</span>
                <span class="text-lg font-medium">Manage Products</span>
            </a>
            <a href="{{ route('cart.index') }}" class="bg-white hover:bg-green-50 border rounded-xl p-5 shadow flex items-center space-x-3">
                <span class="text-2xl">🛒</span>
                <span class="text-lg font-medium">Cart</span>
            </a>
            <a href="{{ route('checkout.form') }}" class="bg-white hover:bg-pink-50 border rounded-xl p-5 shadow flex items-center space-x-3">
                <span class="text-2xl">💳</span>
                <span class="text-lg font-medium">Checkout</span>
            </a>
            <a href="{{ route('customers.index') }}" class="bg-white hover:bg-yellow-50 border rounded-xl p-5 shadow flex items-center space-x-3">
                <span class="text-2xl">👥</span>
                <span class="text-lg font-medium">Customers</span>
            </a>
            <a href="{{ route('sales.invoice.pdf', 1) }}" class="bg-white hover:bg-purple-50 border rounded-xl p-5 shadow flex items-center space-x-3">
                <span class="text-2xl">📄</span>
                <span class="text-lg font-medium">Export Invoice (ID 1)</span>
            </a>
        </div>
    </div>
@endsection
