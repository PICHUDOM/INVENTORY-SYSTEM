<div id="editPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg w-1/2">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">EDIT ITEM</h2>
        </div>
        <form id="editSupplierForm" action="" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')
            <input type="hidden" id="editItem_id" name="Item_id" value="">
            <div class="mb-4">
                <label for="editItem_Khname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN KHMER</label>
                <input type="text" id="editItem_Khname" name="Item_Khname" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="editItem_Engname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN ENGLISH</label>
                <input type="text" id="editItem_Engname" name="Item_Engname" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="editItem_Cate_Khname" class="block text-sm font-medium text-gray-900 mb-1">CATEGORY</label>
                <select id="editItem_Cate_Khname" name="Item_Cate_id" class="text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- CATEGORY --</option>
                    @foreach ($categories as $data)
                    <option value="{{ $data->Item_Cate_id }}" data-uom-name="{{ $data->Item_Cate_Khname }}">
                        {{ $data->Item_Cate_Khname }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="editExpiry_date" class="block text-sm font-medium text-gray-900 mb-1">EXPIRY DATE</label>
                <input type="date" id="editExpiry_date" name="Expiry_date" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="editimage" class="block text-sm font-medium text-gray-900 mb-1">IMAGE</label>
                <div>
                    <button type="button" class="select-logo" onclick="document.getElementById('editimage').click()">BROWSE</button>
                    <input type="file" id="editimage" name="image" style="display:none">
                </div>
                <img id="imagePreview" src="" alt="Image Preview" class="h-20 w-24 rounded hidden mt-2">
              </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md focus:outline-none mr-2">Save Change</button>
                <button type="button" id="cancelEdit" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md focus:outline-none">Cancel</button>
            </div>
        </form>
    </div>
</div>
