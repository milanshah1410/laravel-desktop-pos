@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">👥 Customers</h2>
    <!-- <a href="{{ url()->previous() }}" 
       class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-700 text-sm">
        ← Back
    </a> -->
</div>

<form method="GET" action="{{ route('customers.index') }}" class="mb-4 flex gap-2 max-w-md">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search customers by name or mobile..."
           class="flex-grow border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
    <button type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Search
    </button>
</form>

<div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
    <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 font-semibold text-gray-700">Name</th>
                <th class="px-4 py-3 font-semibold text-gray-700">Mobile</th>
                <th class="px-4 py-3 font-semibold text-gray-700">Sales</th>
                <th class="px-4 py-3 font-semibold text-gray-700">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{ $customer->name }}</td>
                <td class="px-4 py-3">{{ $customer->mobile }}</td>
                <td class="px-4 py-3">{{ $customer->sales->count() }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('customers.show', $customer->id) }}"
                       class="text-blue-600 hover:underline text-sm">
                       View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                    No customers found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $customers->appends(request()->query())->links() }}
</div>
@endsection
