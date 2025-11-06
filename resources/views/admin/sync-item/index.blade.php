@extends('layouts.master')

@section('title', 'Sync Items')

@section('content')
<div class="p-6">
    <!-- Upload & Template Section -->
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Sync Items</h2>
            <a 
                href="{{ asset('templates/items_template.xlsx') }}" 
                class="flex flex-row items-center space-x-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                </svg>
                <span>Download Template</span>
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-3 rounded-md border border-green-300 bg-green-50 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Upload Form -->
        <form action="{{ route('sync-item.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="showLoader()">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Upload CSV/Excel File</label>
                <input type="file" name="items_file" accept=".csv,.xlsx,.xls"
                    class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required />
                <p class="text-xs text-gray-500 mt-2">Supported formats: CSV, XLSX, XLS</p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Sync Now
                </button>
                <a href="{{ url()->previous() }}" class="px-5 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@if (session('success'))
<script>
    toastr.success(@json(session('success')));
</script>
@endif

<script>
    // Fake loader + toast on submit (before backend logic is ready)
    function showLoader() {
        toastr.info("Processing your file...");
    }
</script>
@endsection