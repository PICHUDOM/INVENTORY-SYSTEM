<!-- Create User Popup Overlay -->
<div class="Create-popup-overlay hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

<!-- Create User Popup -->
<div class="Create-popup hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-lg max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white">NEW USER</h2>
        </div>
        <form action="{{ route('createUser') }}" method="POST" enctype="multipart/form-data" id="Create-user-form" class="space-y-4 px-6 py-2">
            @csrf
            <div class="relative text-center">
                <label for="U_photo" class="block mb-1 font-semibold">PHOTO:</label>
                <div class="relative inline-block">
                    <!-- Image Preview -->
                    <img id="U_photo_preview" src="images/user.png" class="h-32 w-32 rounded-full" alt="Profile">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-full">
                        <div class="p-2 cursor-pointer hover:bg-opacity-75 transition rounded-full" onclick="document.getElementById('U_photo').click();">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                </div>
                <input type="file" id="U_photo_preview" name="U_photo" hidden accept="image/*">
            </div>
            
            <div class="flex px-4">
                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="U_name" class="block mb-1">USERNAME:</label>
                        <input type="text" id="U_name" name="U_name" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="R_id" class="block mb-1">ROLE:</label>
                        <select  id="R_id" name="R_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- ROLE --</option>
                            @foreach ($role as $role)
                                <option value="{{ $role->R_id }}">{{ $role->R_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="L_id" class="block">LOCATION :</label>
                        <select id="L_id" name="L_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- LOCATION --</option>
                            @foreach ($location as $data)
                                <option value="{{ $data->L_id }}">{{ $data->L_address }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="sys_name" class="block mb-1">SYSTEM NAME :</label>
                        <input type="text" id="sys_name" name="sys_name" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="U_contact" class="block mb-1">CONTACT :</label>
                        <input type="text" id="U_contact" name="U_contact" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="S_id" class="block mb-1">SHOP</label>
                        <select  id="S_id" name="S_id" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="" disabled selected>-- SHOP --</option>
                            @foreach ($shop_se as $data)
                                <option value="{{ $data->S_id }}">{{ $data->S_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-1">PASSWORD:</label>
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">SAVE</button>
                <button type="button" id="close-user-popup" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition" onclick="window.location.reload();">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('createUserButton').addEventListener('click', function (event) {
        event.preventDefault();
        document.querySelector('.Create-popup-overlay').classList.remove('hidden');
        document.querySelector('.Create-popup').classList.remove('hidden');
    });

    document.getElementById('close-user-popup').addEventListener('click', function () {
        document.querySelector('.Create-popup-overlay').classList.add('hidden');
        document.querySelector('.Create-popup').classList.add('hidden');
    });

    document.querySelector('.Create-popup-overlay').addEventListener('click', function () {
        document.querySelector('.Create-popup-overlay').classList.add('hidden');
        document.querySelector('.Create-popup').classList.add('hidden');
    });

    // Image Preview Script
    document.getElementById('U_photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            console.log('File selected:', file.name);
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('U_photo_preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            console.log('No file selected');
        }
    });
</script>

