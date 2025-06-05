@if(route('dashboard') !== url()->current())

<a href="{{ route('dashboard') }}" class="bg-white text-blue-600 hover:text-blue-800 border border-blue-200 px-4 py-2 rounded shadow-sm">
← Back
</a>

@endif
