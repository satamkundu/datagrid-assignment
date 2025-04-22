@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Add Family</h2>
            <a href="{{ route('families.index') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                View Families
            </a>
        </div>
        <form action="{{ route('families.store') }}" method="POST" enctype="multipart/form-data" id="familyForm">
            @csrf

            <!-- Head Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label for="name" class="mb-1 font-medium">Name <span class="text-red-500">*</span></label>
                    <input id="name" name="name" type="text" class="border p-2 rounded"
                        placeholder="Enter your name" required>
                </div>

                <div class="flex flex-col">
                    <label for="surname" class="mb-1 font-medium">Surname <span class="text-red-500">*</span></label>
                    <input id="surname" name="surname" type="text" class="border p-2 rounded"
                        placeholder="Enter your surname" required>
                </div>

                <div class="flex flex-col">
                    <label for="birthdate" class="mb-1 font-medium">Birth Date <span class="text-red-500">*</span></label>
                    <input id="birthdate" name="birthdate" type="date" class="border p-2 rounded"
                        placeholder="Select your birth date" required>
                </div>

                <div class="flex flex-col">
                    <label for="mobile" class="mb-1 font-medium">Mobile Number <span class="text-red-500">*</span></label>
                    <input id="mobile" name="mobile" type="text" class="border p-2 rounded"
                        placeholder="Enter your mobile number" required>
                </div>

                <div class="flex flex-col">
                    <label for="address" class="mb-1 font-medium">Address <span class="text-red-500">*</span></label>
                    <input id="address" name="address" type="text" class="border p-2 rounded"
                        placeholder="Enter your address" required>
                </div>

                <div class="flex flex-col">
                    <label for="state" class="mb-1 font-medium">State <span class="text-red-500">*</span></label>
                    <select name="state" id="state" class="border p-2 rounded select2" required>
                        <option value="">Select State</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="city" class="mb-1 font-medium">City <span class="text-red-500">*</span></label>
                    <select name="city" id="city" class="border p-2 rounded select2" required>
                        <option value="">Select City</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="pincode" class="mb-1 font-medium">Pincode <span class="text-red-500">*</span></label>
                    <input id="pincode" name="pincode" type="text" class="border p-2 rounded"
                        placeholder="Enter your pincode" required>
                </div>

                <div class="flex flex-col">
                    <label for="marital_status" class="mb-1 font-medium">Marital Status <span
                            class="text-red-500">*</span></label>
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
                    <label for="photo" class="mb-1 font-medium">Photo <span class="text-xs text-gray-500">(PNG, JPG,
                            JPEG up to 2MB)</span></label>
                    <input id="photo" name="photo" type="file" accept=".png,.jpg,.jpeg"
                        class="border p-2 rounded" placeholder="Choose a photo" onchange="validateFileInput(this, 2048)">
                </div>
            </div>

            <!-- Hobbies -->
            <div class="mt-6" id="hobbies-container">
                <label class="block mb-2 font-medium">Hobbies <span class="text-red-500">*</span></label>
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
                    class="w-full px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Add Family</button>
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
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all member-name"
                    required>
            </div>

            <div class="flex flex-col">
                <label for="members[_index_][birthdate]" class="mb-1 font-medium text-gray-700">Birth Date</label>
                <input id="members[_index_][birthdate]" name="members[_index_][birthdate]" type="date"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all member-birthdate"
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
                <label for="members[_index_][photo]" class="mb-1 font-medium text-gray-700">Photo<span class="text-xs text-gray-500">(PNG, JPG,
                    JPEG up to 2MB)</span></label>
                <input id="members[_index_][photo]" name="members[_index_][photo]" type="file" accept=".png,.jpg,.jpeg"
                    class="border p-2 rounded focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all" onchange="validateFileInput(this, 2048)">
            </div>
        </div>
    </template>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialize components and event handlers
        $(function() {
            initializeSelect2();
            initializeBirthdateValidation();
            initializeMaritalStatus();
            initializeMobileNumberManagement();
            initializePincodeValidation();
            initializeMemberManagement();
            initializeHobbyManagement();
            initializeLocationData();
            initializeFormSubmission();
        });

        // Component initialization functions
        function initializeSelect2() {
            $('.select2').select2();
        }

        function initializePincodeValidation() {
            $('#pincode').on('input', function() {
                // Remove any non-digit characters
                let value = $(this).val().replace(/\D/g, '');

                // Limit to 6 digits
                if (value.length > 6) {
                    value = value.slice(0, 6);
                }
                $(this).val(value);
            });

            $('#pincode').on('blur', function() {
                const value = $(this).val().replace(/\D/g, '');
                if (value.length !== 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Pincode',
                        text: 'Please enter a valid 6-digit pincode'
                    });
                    $(this).val('');
                }
            });
        }

        function initializeBirthdateValidation() {
            $('input[name="birthdate"]').on('change', function() {
                const age = getAge($(this).val());
                if (age < 21) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Age Restriction',
                        text: 'Head of family must be at least 21 years old.'
                    });
                    $(this).val('');
                }
            });
        }

        function initializeMobileNumberManagement() {
            $('#mobile').on('input', function() {
                // Remove any non-digit characters
                let value = $(this).val().replace(/\D/g, '');

                // Limit to 10 digits
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                $(this).val(value);
            });

            $('#mobile').on('blur', function() {
                const value = $(this).val().replace(/\D/g, '');
                if (value.length !== 10) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Mobile Number',
                        text: 'Please enter a valid 10-digit mobile number'
                    });
                    $(this).val('');
                }
            });
        }

        // Member management functionality
        function initializeMemberManagement() {
            let memberIndex = 0;

            $('#addMember').click(function() {
                if (!isLastMemberValid()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Details',
                        text: 'Please complete the previous member details before adding another.'
                    });
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
        }

        function validateFileInput(input, maxSizeKB) {
            const file = input.files[0];
            if (file) {
                // Check file size
                const fileSizeKB = file.size / 1024;
                if (fileSizeKB > maxSizeKB) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: `File size must be less than ${maxSizeKB/1024}MB`
                    });
                    input.value = '';
                    return false;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Please upload only JPG, JPEG or PNG files'
                    });
                    input.value = '';
                    return false;
                }
            }
            return true;
        }

        // Hobby management functionality
        function initializeHobbyManagement() {
            const hobbyList = $('#hobby-list');
            const addHobbyBtn = $('#add-hobby');

            addHobbyBtn.on('click', function() {
                const hobbyItems = hobbyList.find('.hobby-item');
                const lastHobby = hobbyItems.last();

                if (lastHobby.length && !lastHobby.find('input').val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Hobby',
                        text: 'Please enter a hobby before adding another'
                    });
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
        }

        // Location data management
        function initializeLocationData() {
            fetchStates();
            $('#state').on('change', fetchCities);
        }

        // Form submission handling
        function initializeFormSubmission() {
            $('#familyForm').on('submit', function(e) {
                e.preventDefault();
                submitForm(this);
            });
        }

        function initializeMaritalStatus() {
            // Handle head's marital status
            $('.marital-status').on('change', function() {
                const isMarried = $(this).val() === 'Married';
                $('#wedding_container').toggleClass('hidden', !isMarried);
                $('#wedding_date').prop('required', isMarried);
            });

            // Handle member's marital status
            $(document).on('change', '.member-status', function() {
                const container = $(this).closest('.member');
                const weddingContainer = container.find('.wedding-container');
                const weddingDateInput = container.find('input[name$="[wedding_date]"]');
                const isMarried = $(this).val() === 'Married';

                weddingContainer.toggleClass('hidden', !isMarried);
                weddingDateInput.prop('required', isMarried);
            });
        }
        // Utility functions
        function getAge(dateString) {
            const today = new Date();
            const birthDate = new Date(dateString);
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function isLastMemberValid() {
            const last = $('#members .member').last();
            if (last.length === 0) return true;
            const name = last.find('.member-name').val();
            const birthdate = last.find('.member-birthdate').val();
            const status = last.find('.member-status').val();
            console.log(name, birthdate, status);
            return name && birthdate && status;
        }

        // AJAX functions
        function fetchStates() {
            $.ajax({
                url: "https://countriesnow.space/api/v0.1/countries/states",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    country: "India"
                }),
                success: function(res) {
                    if (res.data && res.data.states) {
                        $('#state').empty().append('<option value="">Select State</option>');
                        res.data.states.forEach(state => {
                            $('#state').append(`<option value="${state.name}">${state.name}</option>`);
                        });
                    }
                }
            });
        }

        function fetchCities() {
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
                            $('#city').append(`<option value="${city}">${city}</option>`);
                        });
                    }
                }
            });
        }

        function submitForm(form) {
            let formData = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').addClass('opacity-50 cursor-not-allowed').prop('disabled', true)
                        .text('Submitting...');
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Family created successfully!',
                        timer: 2000
                    }).then(() => {
                        window.location.href = "{{ route('families.index') }}";
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    if (xhr.status === 422) {
                        let errorMessage = '';
                        let errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            errorMessage += `${key}: ${errors[key][0]}\n`;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMessage
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please check your input.'
                        });
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeClass('opacity-50 cursor-not-allowed').prop('disabled',
                        false).text('Add Family');
                }
            });
        }
    </script>
@endsection
