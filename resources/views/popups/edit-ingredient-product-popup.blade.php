<div id="EditIngredientPopup" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden z-60">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2 text-center">EDIT INGREDIENT</h2>
        </div>
        <form action="/setting/${proId}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')
            <input type="hidden" id="IPI_id" name="IPI_id" value="">
            <div class="mb-4 flex justify-center">
                <label for="Item_Engname" class="block text-2xl font-bold text-gray-900 text-center mb-1"></label>
            </div>
            <div class="mb-4">
                <label class="block text-md font-semibold text-gray-900 mb-1">ធាតុផ្សំ</label>
                <select id="IIQ_name" name="IIQ_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 mb-1" onchange="handleSelect(event)">
                    <option value=""  disabled selected>Select an Ingredient</option>
                    <option value="createnewITEM">++ CREATE NEW ING ++</option>
                    @foreach ($ingredientQty as $data)
                    <option value="{{ $data->IIQ_id }}">
                        {{ $data->IIQ_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Save Change</button>
                <button type="button" id="closeEditIngredientPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">Cancel</button>
            </div>
        </form>
    </div>
</div>
@include('popups.create-productIngr')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const editIngredientPopup = document.getElementById('EditIngredientPopup');
    const popupItem_1 = document.getElementById('popupItem_1');
    const closeEditIngredientPopup = document.getElementById('closeEditIngredientPopup');
    const closeCreateItemPopup = document.getElementById('closeCreateItemPopup');

    document.querySelectorAll('.edit-ingredient-btn').forEach(button => {
        button.addEventListener('click', () => {
            const productName = button.getAttribute('data-product-name');
            const itemName = button.getAttribute('data-item-name');
            const qty = button.getAttribute('data-qty');
            const uom = button.getAttribute('data-uom');
            const proId = button.getAttribute('data-pro-id');
            editIngredientPopup.querySelector('label[for="Item_Engname"]').textContent = productName;

            editIngredientPopup.querySelector('input[name="IPI_id"]').value = proId;

            // Update form action with the correct ID
            const form = editIngredientPopup.querySelector('form');
            form.action = `/setting/test/${proId}`;

            // Show the popup
            editIngredientPopup.classList.remove('hidden');
        });
    });

    closeEditIngredientPopup.addEventListener('click', () => {
        // Hide the popup
        editIngredientPopup.classList.add('hidden');
    });
    closeCreateItemPopup.addEventListener('click', () => {
        // Hide the popup
        popupItem_1.classList.add('hidden');
    });
});

function handleSelect(event) {
    var selectedValue = event.target.value;
    if (selectedValue === 'createnewITEM') {
        togglePopup('popupItem_1');
    }
}
function togglePopup(popupId) {
    const popup = document.getElementById(popupId);
    if (popup) {
        popup.classList.toggle('hidden');
    }
}
</script>
