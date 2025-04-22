@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6">Family Details</h2>

    <!-- Family Head -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><strong>Name:</strong> {{ $family->name }} {{ $family->surname }}</div>
        <div><strong>Birthdate:</strong> {{ $family->birthdate }}</div>
        <div><strong>Mobile:</strong> {{ $family->mobile }}</div>
        <div><strong>Address:</strong> {{ $family->address }}</div>
        <div><strong>State:</strong> {{ $family->state }}</div>
        <div><strong>City:</strong> {{ $family->city }}</div>
        <div><strong>Pincode:</strong> {{ $family->pincode }}</div>
        <div><strong>Marital Status:</strong> {{ $family->marital_status }}</div>
        @if($family->marital_status == 'Married')
            <div><strong>Wedding Date:</strong> {{ $family->wedding_date }}</div>
        @endif
        <div>
            <strong>Hobbies:</strong>
            @if(is_array($family->hobbies))
                {{ implode(', ', $family->hobbies) }}
            @elseif(is_string($family->hobbies))
                {{ implode(', ', json_decode($family->hobbies, true) ?? []) }}
            @else
                No hobbies listed
            @endif
        </div>
        
        <div>
            <strong>Photo:</strong><br>
            @if($family->photo)
                <img src="{{ asset('storage/' . $family->photo) }}" alt="Photo" class="h-32 rounded mt-2">
            @else
                No photo uploaded
            @endif
        </div>
    </div>

    <!-- Members -->
    <h3 class="text-xl font-bold mt-8">Family Members ({{ $family->members->count() }})</h3>
    <div class="space-y-6 mt-4">
        @foreach($family->members as $member)
        <div class="border p-4 rounded bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><strong>Name:</strong> {{ $member->name }}</div>
                <div><strong>Birthdate:</strong> {{ $member->birthdate }}</div>
                <div><strong>Marital Status:</strong> {{ $member->marital_status }}</div>
                @if($member->marital_status == 'Married')
                    <div><strong>Wedding Date:</strong> {{ $member->wedding_date }}</div>
                @endif
                <div><strong>Education:</strong> {{ $member->education }}</div>
                <div>
                    <strong>Photo:</strong><br>
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="Member Photo" class="h-24 rounded mt-2">
                    @else
                        No photo uploaded
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('families.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Back to List</a>
    </div>
</div>
@endsection
