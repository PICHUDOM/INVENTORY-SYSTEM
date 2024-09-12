@extends('layouts.app-nav')

@section('content')
<div class="flex flex-col">
  <div class="bg-background flex flex-col items-center flex-grow px-4 md:px-0 mt-2">
    <div class="flex flex-col md:flex-row justify-between items-center w-full md:w-4/5">
      <a href="#" id="createButton" class="bg-primary text-primary-foreground py-1 px-8 rounded-lg md:mb-3 sm:mb-2">CREATE</a>
      <div class="relative flex w-full md:w-auto">
        <form id="searchForm" method="GET" class="w-full md:w-auto flex items-center">
            <input  id="searchInput" type="text" name="search" placeholder="Search..." class="border border-input rounded-full py-1 px-4 pl-10 w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-primary"  />
            <button type="submit" class="bg-gray-200 rounded-full py-1 px-4 absolute right-0 top-0 mt-1 mr-2 flex items-center justify-center">
                <i class="fas fa-search text-gray-500"></i>
            </button>
        </form>
      </div>
    </div>
    <div class="w-full md:w-4/5 border-2 border-bsicolor p-2 font-times">
      <div class="overflow-x-auto">
        <h4 class="text-center font-bold pb-4 text-lg"><u>SUPPLIER INFORMATION</u></h4>
        <table class="min-w-full bg-white border-collapse">
          <thead>
            <tr class="bg-primary text-primary-foreground text-lg">
              <th class="py-4 px-4 border border-white">NO.</th>
              <th class="py-4 px-4 border border-white">NAME</th>
              <th class="py-4 px-4 border border-white">CONTACT</th>
              <th class="py-4 px-4 border border-white">ADDRESS</th>
              <th class="py-4 px-4 border border-white">ACTION</th>
            </tr>
          </thead>
          <tbody id="inventoryTableBody">
            @foreach ($supplier as $data)
            <tr class="{{ $loop->index % 2 === 0 ? 'bg-zinc-200' : 'bg-zinc-300' }} text-base {{ $loop->first ? 'border-t-4' : '' }} text-center border-white">
              <td class="py-3 px-4 border border-white">{{ $data->Sup_id ?? 'null' }}</td>
              <td class="py-3 px-4 border border-white">{{ $data->Sup_name ?? 'null' }}</td>
              <td class="py-3 px-4 border border-white">{{ $data->Sup_contact ?? 'null' }}</td>
              <td class="py-3 px-4 border border-white">{{ $data->Sup_address ?? 'null' }}</td>
              <td class="py-3 border border-white">
                <button class="relative bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="openEditPopup({{ $data->Sup_id }}, '{{ $data->Sup_name }}', '{{ $data->Sup_contact }}', '{{ $data->Sup_address }}')">
                  <i class="fas fa-edit fa-xs"></i>
                  <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Edit</span>
                </button>
                <button class="relative bg-red-500 hover:bg-red-600 active:bg-red-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" onclick="if(confirm('{{ __('Are you sure you want to delete?') }}')) { window.location.href='suppliers/destroy/{{$data->Sup_id}}'; }">
                  <i class="fas fa-trash-alt fa-xs"></i>
                  <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Delete</span>
                </button>
                <button class="relative bg-green-500 hover:bg-green-600 active:bg-green-700 text-white py-2 px-4 rounded-md focus:outline-none transition duration-150 ease-in-out group" 
                onclick="toggleActive(this)">
                <i class="fas fa-toggle-on fa-xs"></i>
                <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-1 px-2 py-1 text-xs text-white bg-gray-800 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">Active</span>
            </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Include the popup form -->
  @include('popups.create-supplier-popup')
  @include('popups.edit-supplier-popup')

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#searchForm').on('submit', function(event) {
    event.preventDefault();
    let searchQuery = $('#searchInput').val();

    $.ajax({
      url: '{{ route("supplier.search") }}',
      type: 'GET',
      data: { search: searchQuery },
      success: function(response) {
        $('#inventoryTableBody').html(response.html);
      }
    });
  });
  function openEditPopup(Sup_id, Sup_name, Sup_contact, Sup_address) {
    document.getElementById('editSupId').value = Sup_id;
    document.getElementById('editSupName').value = Sup_name;
    document.getElementById('editSupContact').value = Sup_contact;
    document.getElementById('editSupAddress').value = Sup_address;
    document.getElementById('editSupplierForm').action = `/suppliers_update/${Sup_id}`;
    document.getElementById('editPopup').classList.remove('hidden');
  }

    const createButton = document.getElementById('createButton');
    const popupForm = document.getElementById('popupSupplier');
    createButton.addEventListener('click', () => {
      popupForm.classList.remove('hidden');
    });
    document.getElementById('cancelEdit').addEventListener('click', function() {
        document.getElementById('editPopup').classList.add('hidden');
    });

    function toggleActive(button) {
    // Toggle the active state
    if (button.classList.contains('active')) {
        // Change to inactive state
        console.log(123);       
        button.classList.remove('active');
        button.style.backgroundColor = '#FF0000'; // Red color for inactive
        button.innerHTML = '<i class="fas fa-toggle-off fa-xs"></i>';
    } else {
      console.log(678);       

        // Change to active state
        button.classList.add('active');
        button.style.backgroundColor = '#008000'; // Green color for active
        button.innerHTML = '<i class="fas fa-toggle-on fa-xs"></i>';
    }
}

</script>
@endsection
