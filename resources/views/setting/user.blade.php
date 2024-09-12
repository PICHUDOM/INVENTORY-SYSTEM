@extends('layouts.setting')

@section('content')
<div class="max-w-screen-lg mx-auto">
    <!-- Create User Button -->
    <div class="flex flex-col md:flex-row justify-between items-center w-full md:w-4/5">
        <a href="#" id="createUserButton" class="bg-primary text-primary-foreground py-1 px-4 rounded-lg md:mb-3 sm:mb-2 text-sm">CREATE</a>
    </div>

    <!-- User Grid -->
    <div class="max-w-screen-lg mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
        @foreach ($user as $data)
        <div class="relative bg-gray-100 rounded-lg shadow-lg overflow-hidden p-3">
            <div class="border-b-2 border-bsicolor">
                <div class="rounded-lg">
                    <div class="relative">
                        <img src="{{ $data->U_photo ? asset('storage/' . $data->U_photo) : asset('images/shop.jpg') }}" alt="user image" class="rounded-full mb-4 h-32 w-32 object-cover shadow-lg m-auto">
                    </div>
                    <h1 class="text-xl font-semibold mb-2 text-center text-primary">{{ strtoupper($data->U_name) }} ({{ strtoupper($data->InvRole->R_type) }})</h1>
                </div>
            </div>
            <div class="flex justify-center mt-2 space-x-4 relative">
                <!-- Edit Button -->
                <div class="relative group">
                    <button class="bg-blue-600 bg-opacity-100 p-2 rounded-full cursor-pointer hover:bg-opacity-75 transition duration-300 edit-button-user" aria-label="Edit User"
                    data-U_id="{{ $data->U_id }}"
                    data-name="{{ $data->U_name }}"
                    data-role="{{ $data->R_id }}"
                    data-sys-name="{{ $data->sys_name }}"
                    data-contact="{{ $data->U_contact }}"
                    data-photo="{{ $data->U_photo }}"
                    data-password="{{ $data->password }}">
                    <i class="fas fa-edit text-white"></i>
                </button>
                    <div class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-white text-xs bg-gray-600 rounded-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-4">
                        Edit
                    </div>
                </div>
                <!-- Toggle Button -->
                <div class="relative group">
                    <button class="toggle-button p-2 rounded-full cursor-pointer transition duration-300" 
                        onclick="toggleActive(this)"
                        onmouseover="setHover(this, true)"
                        onmouseout="setHover(this, false)"
                        style="background-color: #008000; color: white;">
                        <i class="fas fa-toggle-on"></i>
                        <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Active</span>
                    </button>
                </div>
                <!-- (Your existing toggle button code) -->
            </div>
        </div>
        @endforeach
        
    </div>

    <!-- Include Popups -->
    @include('popups.edit-user-popup')
    @include('popups.create-user-popup')
</div>

<script>
    function toggleActive(button) {
        const icon = button.querySelector('i');
        const statusText = button.querySelector('span');
        
        if (icon.classList.contains('fa-toggle-on')) {
            icon.classList.remove('fa-toggle-on');
            icon.classList.add('fa-toggle-off');
            statusText.textContent = 'Inactive';
            button.style.backgroundColor = '#f00'; // Red
        } else {
            icon.classList.remove('fa-toggle-off');
            icon.classList.add('fa-toggle-on');
            statusText.textContent = 'Active';
            button.style.backgroundColor = '#008000'; // Green
        }
    }

    function setHover(button, isHover) {
        const icon = button.querySelector('i');
        const statusText = button.querySelector('span');
        
        if (icon.classList.contains('fa-toggle-on')) {
            button.style.backgroundColor = isHover ? '#006400' : '#008000';
            statusText.textContent = 'Active';
        } else {
            button.style.backgroundColor = isHover ? '#a11' : '#f00';
            statusText.textContent = isHover ? 'Inactive' : 'Inactive';
        }
    }
</script>
@endsection