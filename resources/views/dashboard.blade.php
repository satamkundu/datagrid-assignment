@extends('layouts.app')

@section('content')

    <div class="text-center space-y-6">
        <h1 class="text-3xl font-bold text-gray-700 mb-8">Community Family Management</h1>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <!-- Add Family Button -->
            <button
                id="addFamilyBtn"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow-md hover:bg-blue-700 transition">
                ➕ Add Family
            </button>

            <!-- View Families Button -->
            <button
                id="viewFamiliesBtn"
                class="px-6 py-3 bg-green-600 text-white rounded-xl shadow-md hover:bg-green-700 transition">
                📋 View Families
            </button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#addFamilyBtn').on('click', function () {
                window.location.href = "{{ route('families.create') }}";
            });

            $('#viewFamiliesBtn').on('click', function () {
                window.location.href = "{{ route('families.index') }}";
            });
        });
    </script>

@endsection
