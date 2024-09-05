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
        <h4 class="text-center font-bold pb-4 text-lg">ITEMS INFORMATION</h4>
        <table class="min-w-full bg-white border-collapse">
          <thead>
            <tr class="bg-primary text-primary-foreground text-lg">
              <th class="py-4 px-4 border border-white">NO.</th>
              <th class="py-4 px-4 border border-white">
                <a href="{{ url('/items?sortColumn=Item_Khname&sortOrder=' . (request('sortOrder') == 'asc' ? 'desc' : 'asc') . '&search=' . request('search')) }}">
                  KHMER NAME
                  <i class="fas fa-xs {{ request('sortColumn') == 'Item_Khname' ? (request('sortOrder') == 'asc' ? 'fa-sort-alpha-up' : 'fa-sort-alpha-down') : 'fa-sort-alpha-down' }}"></i>
                </a>
              </th>
              <th class="py-4 px-4 border border-white">
                <a href="{{ url('/items?sortColumn=Item_Engname&sortOrder=' . (request('sortOrder') == 'asc' ? 'desc' : 'asc') . '&search=' . request('search')) }}">
                  ENGLISH NAME
                  <i class="fas fa-xs {{ request('sortColumn') == 'Item_Engname' ? (request('sortOrder') == 'asc' ? 'fa-sort-alpha-up' : 'fa-sort-alpha-down') : 'fa-sort-alpha-down' }}"></i>
                </a>
              </th>
              <th class="py-4 px-4 border border-white">
                <a href="{{ url('/items?sortColumn=category_name&sortOrder=' . (request('sortOrder') == 'asc' ? 'desc' : 'asc') . '&search=' . request('search')) }}">
                  CATEGORY
                  <i class="fas fa-xs {{ request('sortColumn') == 'category_name' ? (request('sortOrder') == 'asc' ? 'fa-sort-alpha-up' : 'fa-sort-alpha-down') : 'fa-sort-alpha-down' }}"></i>
                </a>
              </th>
              <th class="py-4 px-4 border border-white">EXPENSE NAME</th>
              <th class="py-4 px-4 border border-white">IEC ID</th>
              <th class="py-4 px-4 border border-white">EXP DATE</th>
              <th class="py-4 px-4 border border-white">ORDER INFORMATION</th>
              <th class="py-4 px-4 border border-white">ACTION</th>
            </tr>
          </thead>
          <tbody id="">

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function openEditPopup(Item_id, Item_Khname, Item_Engname, iteamCategory, Expiry_date, image) {
  document.getElementById('editItem_id').value = Item_id;
  document.getElementById('editItem_Khname').value = Item_Khname;
  document.getElementById('editItem_Engname').value = Item_Engname;



  document.getElementById('editItem_Cate_Khname').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const uomName = selectedOption.getAttribute('data-uom-name');
});
    document.getElementById('closeItemPopup').addEventListener('click', function() {
        document.getElementById('popupItem').classList.add('hidden');
    });
    document.getElementById('cancelEdit').addEventListener('click', function() {
        document.getElementById('editPopup').classList.add('hidden');
    });
    const createButton = document.getElementById('createButton');
    const popupForm = document.getElementById('popupItem');
    createButton.addEventListener('click', () => {
      popupForm.classList.remove('hidden');
    });
</script>
@endsection
