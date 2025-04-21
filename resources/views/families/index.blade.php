@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">Family List</h2>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Head Name</th>
                <th class="px-4 py-2 text-left">Mobile</th>
                <th class="px-4 py-2 text-center">Members</th>
                <th class="px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $family->name }} {{ $family->surname }}</td>
                    <td class="px-4 py-2">{{ $family->mobile }}</td>
                    <td class="px-4 py-2 text-center">{{ $family->members_count }}</td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('families.show', $family->id) }}" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
