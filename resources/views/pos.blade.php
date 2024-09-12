@extends('layouts.app-nav')

@section('content')
<div class="relative flex items-center justify-center w-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-5xl w-full -mt-32">
        <!-- Display success or error messages -->
        <h2 class="text-2xl font-bold mb-6 text-center">SUBMIT SALE TRANSACTION</h2>
        <form id="posForm" action="{{ route('pos.store') }}" method="POST" class="grid grid-cols-1 gap-4">
            @csrf
        
            <div class="flex flex-wrap gap-4">
        
                <!-- Shop Select -->
                <select name="shop" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>Select shop</option>
                    <option value="BSI">BSI</option>
                </select>
        
                <!-- Location Select -->
                <select name="location" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>Select location</option>
                    <option value="BSI">BSI</option>
                </select>
        
                <!-- Product Select -->
                <select id="product_id" name="product_id" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach ($products as $data)
                        <option value="{{ $data->Pro_id }}" data-name="{{ $data->Pro_name_eng }}">
                            {{ $data->Pro_name_eng }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" id="product_name" name="product_name" value="">
        
                <!-- Add-On Select -->
                <select id="addon_id" name="addon_id" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>Select Add-On</option>
                    @foreach ($addons as $data)
                        <option value="{{ $data->Addons_id }}" data-name="{{ $data->Addons_name }}">
                            {{ $data->Addons_name }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" id="addon_name" name="addon_name" value="">
        
                <!-- Quantity Input -->
                <div class="flex-1 min-w-[150px]">
                    <input type="number" id="quantity" name="quantity" min="1" step="1" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Enter Quantity">
                </div>
        
                <!-- Price Input -->
                <div class="flex-1 min-w-[150px]">
                    <input type="number" id="price" name="price" min="0" step="0.01" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Enter Price">
                </div>
        
                <!-- Currency Select -->
                <select name="currency" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>Select Currency</option>
                    <option value="KHR">Riel(s)</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        
            <!-- Hidden Date Input -->
            <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        
            <!-- Submit Button -->
            <div class="text-end mt-8">
                <button type="submit" class="py-2 px-6 bg-primary text-white rounded-lg hover:bg-blue-700">SUBMIT</button>
            </div>
        </form>        
    </div>
</div>

<script>
document.getElementById('product_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var productName = selectedOption.getAttribute('data-name');
    document.getElementById('product_name').value = productName;
});

document.getElementById('addon_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var addonName = selectedOption.getAttribute('data-name');
    document.getElementById('addon_name').value = addonName;
});
</script>
@endsection
