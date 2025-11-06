@extends('layouts.master')

@section('title', 'Sync Contacts')

@section('content')
<div class="p-6">
    <!-- Upload & Template Section -->
    <div class="bg-white rounded-xl shadow-md p-6 max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Sync Contacts</h2>
            <a 
                href="{{ asset('templates/contacts_template.xlsx') }}" 
                class="flex flex-row items-center space-x-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                </svg>
                <span>Download Template</span>
            </a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-md border border-red-300 bg-red-50 text-red-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-3 rounded-md border border-green-300 bg-green-50 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Upload Form -->
        <form action="{{ route('sync-contacts.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="showLoader()">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Upload CSV/Excel File</label>
                <input type="file" name="contacts_file" accept=".csv,.xlsx,.xls"
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

    <!-- Import Report Section -->
    @if (session('report'))
    <div class="bg-white rounded-xl shadow-md p-6 max-w-5xl mx-auto mt-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Import Report</h3>
        <div class="overflow-x-auto border rounded-lg shadow-sm">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left text-sm font-semibold">#</th>
                        <th class="px-4 py-2 border text-left text-sm font-semibold">Row</th>
                        <th class="px-4 py-2 border text-left text-sm font-semibold">Mobile</th>
                        <th class="px-4 py-2 border text-left text-sm font-semibold">Party ID</th>
                        <th class="px-4 py-2 border text-left text-sm font-semibold">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(session('report')['errors'] as $i => $error)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-4 py-2 border text-sm">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 border text-sm">{{ $error['row'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-sm">{{ $error['mobile'] ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border text-sm">{{ $error['party_id'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-sm text-red-600">{{ $error['reason'] ?? 'No reason provided' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 border text-center text-sm text-gray-500">No errors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
@if (session('success'))
<script>
    toastr.success(@json(session('success')));
</script>
@endif
@endsection