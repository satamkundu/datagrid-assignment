@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">Add Family</h2>
        <form action="{{ route('families.store') }}" method="POST" enctype="multipart/form-data" id="familyForm">
            @csrf

            <!-- Head Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label for="name" class="mb-1 font-medium">Name</label>
                    <input id="name" name="name" type="text" class="border p-2 rounded"
                        placeholder="Enter your name" required>
                </div>

                <div class="flex flex-col">
                    <label for="surname" class="mb-1 font-medium">Surname</label>
                    <input id="surname" name="surname" type="text" class="border p-2 rounded"
                        placeholder="Enter your surname" required>
                </div>

                <div class="flex flex-col">
                    <label for="birthdate" class="mb-1 font-medium">Birth Date</label>
                    <input id="birthdate" name="birthdate" type="date" class="border p-2 rounded"
                        placeholder="Select your birth date" required>
                </div>

                <div class="flex flex-col">
                    <label for="mobile" class="mb-1 font-medium">Mobile Number</label>
                    <input id="mobile" name="mobile" type="text" class="border p-2 rounded"
                        placeholder="Enter your mobile number" required>
                </div>

                <div class="flex flex-col">
                    <label for="address" class="mb-1 font-medium">Address</label>
                    <input id="address" name="address" type="text" class="border p-2 rounded"
                        placeholder="Enter your address" required>
                </div>

                <div class="flex flex-col">
                    <label for="state" class="mb-1 font-medium">State</label>
                    <select name="state" id="state" class="border p-2 rounded select2" required>
                        <option value="">Select State</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="city" class="mb-1 font-medium">City</label>
                    <select name="city" id="city" class="border p-2 rounded select2" required>
                        <option value="">Select City</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="pincode" class="mb-1 font-medium">Pincode</label>
                    <input id="pincode" name="pincode" type="text" class="border p-2 rounded"
                        placeholder="Enter your pincode" required>
                </div>

                <div class="flex flex-col">
                    <label for="marital_status" class="mb-1 font-medium">Marital Status</label>
                    <select id="marital_status" name="marital_status" class="border p-2 rounded marital-status" required>
                        <option value="">Select Marital Status</option>
                        <option value="Married">Married</option>
                        <option value="Unmarried">Unmarried</option>
                    </select>
                </div>

                <div class="flex flex-col hidden" id="wedding_container">
                    <label for="wedding_date" class="mb-1 font-medium">Wedding Date</label>
                    <input id="wedding_date" name="wedding_date" type="date" class="border p-2 rounded"
                        placeholder="Select wedding date">
                </div>

                <div class="flex flex-col">
                    <label for="photo" class="mb-1 font-medium">Photo</label>
                    <input id="photo" name="photo" type="file" accept="image/*" class="border p-2 rounded"
                        placeholder="Choose a photo">
                </div>
            </div>

            <!-- Hobbies -->
            <div class="mt-6" id="hobbies-container">
                <label class="block mb-2 font-medium">Hobbies</label>
                <div id="hobby-list" class="space-y-2">
                    <div class="hobby-item flex gap-2">
                        <input type="text" name="hobbies[]" class="border p-2 rounded flex-1"
                            placeholder="Enter your hobby" required>
                        <button type="button"
                            class="delete-hobby px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 hidden">
                            &times;
                        </button>
                    </div>
                </div>
                <button type="button" id="add-hobby"
                    class="mt-2 text-sm bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-gray-700 rounded">
                    + Add Hobby
                </button>
            </div>
            </script>

            <!-- Members -->
            <h3 class="text-xl font-bold mt-8">Family Members</h3>
            <div id="members" class="space-y-4 mt-4"></div>
            <button type="button" id="addMember"
                class="mt-2 text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">+
                Add
                Member</button>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Add
                    Family</button>
            </div>
        </form>
    </div>

    <!-- Template for member -->
    <template id="memberTemplate">
        <div
            class="grid grid-cols-1 md:grid-cols-2 gap-4 member border p-4 rounded bg-gray-50 relative shadow-sm hover:shadow-md transition-shadow">
            <button type="button"
                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center shadow-sm transition-colors delete-member">&times;</button>

            <div class="flex flex-col">
                <label for="members[_index_][name]" class="mb-1 font-medium text-gray-700">Name</label>
                <input id="members[_index_][name]" name="members[_index_][name]" type="text"
                    placeholder="Enter member's name"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all"
                    required>
            </div>

            <div class="flex flex-col">
                <label for="members[_index_][birthdate]" class="mb-1 font-medium text-gray-700">Birth Date</label>
                <input id="members[_index_][birthdate]" name="members[_index_][birthdate]" type="date"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all"
                    required>
            </div>

            <div class="flex flex-col">
                <label for="members[_index_][marital_status]" class="mb-1 font-medium text-gray-700">Marital
                    Status</label>
                <select id="members[_index_][marital_status]" name="members[_index_][marital_status]"
                    class="border p-2 rounded member-status focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all"
                    required>
                    <option value="">Select Marital Status</option>
                    <option value="Married">Married</option>
                    <option value="Unmarried">Unmarried</option>
                </select>
            </div>

            <div class="flex flex-col hidden wedding-container">
                <label for="members[_index_][wedding_date]" class="mb-1 font-medium text-gray-700">Wedding Date</label>
                <input id="members[_index_][wedding_date]" name="members[_index_][wedding_date]" type="date"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all">
            </div>

            <div class="flex flex-col">
                <label for="members[_index_][education]" class="mb-1 font-medium text-gray-700">Education</label>
                <input id="members[_index_][education]" name="members[_index_][education]" type="text"
                    placeholder="Enter education details"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all">
            </div>

            <div class="flex flex-col">
                <label for="members[_index_][photo]" class="mb-1 font-medium text-gray-700">Photo</label>
                <input id="members[_index_][photo]" name="members[_index_][photo]" type="file" accept="image/*"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all">
            </div>
        </div>
    </template>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        $(function() {
            $('.select2').select2();

            $('.marital-status').on('change', function() {
                $('#wedding_container').toggleClass('hidden', $(this).val() !== 'Married');
            });

            let memberIndex = 0;
            let allowAddMember = true;

            function isLastMemberValid() {
                const last = $('#members .member').last();
                if (last.length === 0) return true;
                const name = last.find('.member-name').val();
                const birthdate = last.find('.member-birthdate').val();
                const status = last.find('.member-status').val();
                return name && birthdate && status;
            }

            $('#addMember').click(function() {
                if (!isLastMemberValid()) {
                    alert('Please complete the previous member details before adding another.');
                    return;
                }
                const tpl = $('#memberTemplate').html().replaceAll('_index_', memberIndex);
                $('#members').append(tpl);
                memberIndex++;
            });

            $(document).on('change', '.member-status', function() {
                const container = $(this).closest('.member');
                const dateInput = container.find('.wedding-container');
                dateInput.toggleClass('hidden', $(this).val() !== 'Married');
            });

            $(document).on('click', '.delete-member', function() {
                $(this).closest('.member').remove();
            });

        });

        $(document).ready(function() {
            const hobbyList = $('#hobby-list');
            const addHobbyBtn = $('#add-hobby');

            addHobbyBtn.on('click', function() {
                const hobbyItems = hobbyList.find('.hobby-item');
                const lastHobby = hobbyItems.last();

                if (lastHobby.length && !lastHobby.find('input').val()) {
                    alert('Please enter a hobby before adding another');
                    return;
                }

                const newHobby = hobbyItems.first().clone();
                newHobby.find('input').val('');
                newHobby.find('.delete-hobby').removeClass('hidden');
                hobbyList.append(newHobby);
            });

            hobbyList.on('click', '.delete-hobby', function() {
                $(this).closest('.hobby-item').remove();
            });
        });

        $(document).ready(function() {
            // AJAX call request to fetch states of India
            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/states",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    country: "India"
                }),
                success: function(res) {
                    // Check if response contains states data
                    if (res.data && res.data.states) {
                        // Clear existing options and add default option
                        $('#state').empty().append('<option value="">Select State</option>');
                        // Iterate through states and append options to select element
                        res.data.states.forEach(state => {
                            $('#state').append(
                                `<option value="${state.name}">${state.name}</option>`);
                        });
                    }
                }
            });

            // AJAX call request to fetch cities of selected state of India
            $('#state').on('change', function() {
                const state = $(this).val();
                if (!state) return;

                $.ajax({
                    url: "https://countriesnow.space/api/v0.1/countries/state/cities",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        country: "India",
                        state: state
                    }),
                    success: function(res) {
                        if (res.data) {
                            $('#city').empty().append('<option value="">Select City</option>');
                            res.data.forEach(city => {
                                $('#city').append(
                                    `<option value="${city}">${city}</option>`);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
