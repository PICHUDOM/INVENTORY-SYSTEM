<div class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">DETAIL INGRENDIENT INFORMATION</h1>
        <div class="relative flex w-full md:w-auto">
            <form id="searchForm" method="GET" class="w-full md:w-auto flex items-center relative">
                <input id="searchInput" type="text" placeholder="Search..." class="border border-input rounded-full py-1 px-4 pl-10 w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-primary" required />
                <button type="submit" class="bg-gray-200 rounded-full py-1 px-4 absolute right-0 top-0 mt-1 mr-2 flex items-center justify-center" aria-label="Search">
                    <i class="fas fa-search text-gray-500"></i>
                </button>
            </form>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4 mt-2">
            <!-- Example Product Card -->
            @foreach ($productIngredients as $data)
            <div class="bg-white p-2 rounded-lg shadow-md flex flex-col">
                <img src="images/shop.jpg" alt="Hot Vanilla Latte" class="w-full h-20 object-cover rounded-t-lg">
                <div class="p-2 flex-grow">
                    <h2 class="text-sm text-gray-800 mb-1 font-semibold">{{$data->Product_ENGName}}</h2>
                    <h3 class="text-sm text-gray-900 mb-2 font-semibold"><u>Ingredients</u></h3>
                    <h3 class="text-sm text-gray-700">{{$data->Item_ENGName . '	' . $data->Qty . '	' . $data->UOM}}</h3>
                </div>
                <div class="mt-auto flex justify-between p-2">
                    <div class="relative group">
                        <!-- Add data attributes here -->
                        <button class="edit-ingredient-btn bg-blue-500 text-white px-3 py-1 rounded cursor-pointer transition duration-300 hover:bg-blue-600"
                        data-pro-id="{{ $data->IPI_id }}"
                        data-IIQ_name="{{$data->IIQ_name}}"
                        data-product-name="{{$data->Product_Name}}"
                        data-item-name="{{$data->Item_Name}}"
                        data-qty="{{$data->Qty}}"
                        data-uom="{{$data->UOM}}">
                    <i class="fas fa-edit fa-sm"></i>
                    <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Edit</span>
                </button>
                    </div>
                    <div class="relative group">
                        <button class="toggle-button px-3 py-1 rounded cursor-pointer transition duration-300" 
                            onclick="toggleActive(this)"
                            onmouseover="setHover(this, true)"
                            onmouseout="setHover(this, false)"
                            style="background-color: #008000; color: white;">
                            <i class="fas fa-toggle-on fa-sm"></i>
                            <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Active</span>
                        </button>
                    </div>
                </div>                
            </div>
            @endforeach
            <!-- Repeat Product Card for each product -->
        </div>
        <div class="mt-4">
            {{ $invProduct->links() }}
        </div>
        @include('popups.edit-ingredient-product-popup')
    </div>
</div>


<script>
    function toggleActive(button) {
        const icon = button.querySelector('i');
        const activeText = button.querySelector('span');
        
        if (icon.classList.contains('fa-toggle-on')) {
            icon.classList.remove('fa-toggle-on');
            icon.classList.add('fa-toggle-off');
            activeText.textContent = 'Inactive';
            button.style.backgroundColor = '#f00';
        } else {
            icon.classList.remove('fa-toggle-off');
            icon.classList.add('fa-toggle-on');
            activeText.textContent = 'Active';
            button.style.backgroundColor = '#008000';
        }
    }

    function setHover(button, isHover) {
        if (button.querySelector('i').classList.contains('fa-toggle-on')) {
            button.style.backgroundColor = isHover ? '#006400' : '#008000';
        } else {
            button.style.backgroundColor = isHover ? '#a11' : '#f00';
        }
    }
</script>
