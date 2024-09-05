<!-- Popup container -->
<div id="popupItem_1" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }} z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW INGREDIENT</h2>
        </div>
        <form id="itemForm" action="{{ route('setting.createIng') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="Qty" class="block text-sm font-medium text-gray-900 mb-1">QTY</label>
                <input type="text" id="Qty" name="Qty" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Item_Engname') is-invalid @enderror"  oninput="updateTotalPrice()">
                @error('Qty')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Item_Engname" class="block text-sm font-medium text-gray-900 mb-1">Select UOM</label>
                <select id="Item_Engname" name="Item_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected> UOM NAME </option>
                    @foreach ($item as $data)
                        <option value="{{ $data->Item_id }}">{{ $data->Item_Engname }}</option> 
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="UOM_abb" class="block text-sm font-medium text-gray-900 mb-1">Select UOM</label>
                <select id="UOM_abb" name="UOM_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>UOM NAME</option>
                    @foreach ($uom as $data)
                        <option value="{{ $data->UOM_id }}">{{ $data->UOM_abb }}</option> 
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-900 mb-1">Price</label>
                <input type="text" id="price" name="IIQ_name" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Save</button>
                <button type="button" id="closeItemPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Your HTML content -->

<script>
function updateTotalPrice() {
    var qtyElement = document.getElementById('Qty');
    var qtyValue = qtyElement.value || 0;

    var itemElement = document.getElementById('Item_Engname');
    var selectedItem = itemElement.options[itemElement.selectedIndex].text;

    var uomElement = document.getElementById('UOM_abb');
    var selectedUOM = uomElement.options[uomElement.selectedIndex].text;

    // Combine the fields into the desired format: "Item Name Qty UOM"
    var combinedString = selectedItem + " " + qtyValue + " " + selectedUOM;

    var priceElement = document.getElementById('price');
    priceElement.value = combinedString;
}

// Update the combined string whenever quantity, item, or UOM changes
document.getElementById('Qty').addEventListener('input', updateTotalPrice);
document.getElementById('Item_Engname').addEventListener('change', updateTotalPrice);
document.getElementById('UOM_abb').addEventListener('change', updateTotalPrice);

// Initialize the form with the correct combined string
document.addEventListener('DOMContentLoaded', function() {
    updateTotalPrice();
});
function generatePriceString(qty, item) {
    // Example logic to generate a string (replace with your actual logic)
    var price = qty * 10; // Example: each unit costs $10
    return  price.toFixed(2) + qty + " " + item;
}

    document.getElementById('closeItemPopup').addEventListener('click', function() {
        // Hide the popup
        document.getElementById('popupItem_1').classList.add('hidden');
        
        // Clear the form data
        document.getElementById('itemForm').reset();
    });

    // Display the popup if validation errors are present
    if ("{{ $errors->any() }}") {
        document.getElementById('popupItem_1').classList.remove('hidden');
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
