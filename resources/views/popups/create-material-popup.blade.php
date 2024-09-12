<!-- Popup container -->
<div id="popupItem" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }} z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW MATERIAL</h2>
        </div>
        <form id="itemForm" action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="Item_Khname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN KHMER</label>
                <input type="text" id="Item_Khname" name="Item_Khname" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Item_Khname') is-invalid @enderror" value="{{ old('Item_Khname') }}">
                @error('Item_Khname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Item_Engname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN ENGLISH</label>
                <input type="text" id="Item_Engname" name="Item_Engname" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Item_Engname') is-invalid @enderror" value="{{ old('Item_Engname') }}">
                @error('Item_Engname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Item_Cate_id" class="block text-sm font-medium text-gray-900 mb-1">CATEGORY</label>
                <select id="Item_Cate_id" name="Item_Cate_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Item_Cate_id') is-invalid @enderror">
                    <option value="">-- CATEGORY --</option>
                    @foreach ($categories as $data)
                        <option value="{{ $data->Item_Cate_id }}" {{ old('Item_Cate_id') == $data->Item_Cate_id ? 'selected' : '' }}>
                            {{ $data->Item_Cate_Khname }}
                        </option>
                    @endforeach
                </select>
                @error('Item_Cate_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="Expiry_date" class="block text-sm font-medium text-gray-900 mb-1">EXPIRY DATE</label>
                <input type="date" id="Expiry_date" name="Expiry_date" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Expiry_date') is-invalid @enderror" value="{{ old('Expiry_date') }}">
                @error('Expiry_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-900 mb-1">IMAGE</label>
                <div>
                    <button type="button" class="select-logo" onclick="document.getElementById('image').click()">BROWSE</button>
                    <input type="file" id="image" name="image" class="hidden">
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">SAVE</button>
                <button type="button" id="closeItemPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none" onclick="window.location.reload();">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('closeItemPopup').addEventListener('click', function() {
        // Hide the popup
        document.getElementById('popupItem').classList.add('hidden');
        
        // Clear the form data
        document.getElementById('itemForm').reset();
        
        // Clear file input
        document.getElementById('image').value = '';
    });

    // Display the popup if validation errors are present
    if ("{{ $errors->any() }}") {
        document.getElementById('popupItem').classList.remove('hidden');
        const firstInvalid = document.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.focus({ preventScroll: true });
        }
    }
</script>

<style>
    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>
