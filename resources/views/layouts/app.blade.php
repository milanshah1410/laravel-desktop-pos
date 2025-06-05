<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel POS System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div x-data="{ open: false }" class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="bg-blue-700 text-white w-64 space-y-6 py-7 px-2 hidden md:block">
            <h2 class="text-2xl font-bold px-4">🧾 POS</h2>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Products</a>
                <a href="{{ route('cart.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Cart</a>
                <a href="{{ route('customers.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Customers</a>
                <a href="{{ route('checkout.form') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Checkout</a>
            </nav>
        </aside>

        <!-- Mobile Menu Button -->
        <div class="md:hidden bg-blue-700 text-white p-4 flex justify-between items-center w-full">
            <button @click="open = !open" class="focus:outline-none">
                ☰
            </button>
            <h2 class="text-lg font-semibold">Laravel POS</h2>
        </div>

        <!-- Mobile Sidebar -->
        <div x-show="open" class="md:hidden bg-blue-700 text-white w-full px-4 py-6 absolute z-20">
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Products</a>
                <a href="{{ route('cart.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Cart</a>
                <a href="{{ route('customers.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Customers</a>
                <a href="{{ route('checkout.form') }}" class="block px-4 py-2 rounded hover:bg-blue-600">Checkout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">POS Dashboard</h1>
                <x-back-button />
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
