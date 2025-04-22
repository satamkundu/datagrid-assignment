@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Family List</h2>
        <a href="{{ route('families.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Family
        </a>
    </div>

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
            @if($families->count() > 0)
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
            @else
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                        No families found
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
