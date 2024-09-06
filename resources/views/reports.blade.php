@extends('layouts.app-nav')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="w-4/5 mx-auto">
        <div class="text-center">
            <div class="border-b border-gray-300 mb-12">
                <nav class="flex justify-center space-x-8">
                    <a href="#sale-detail" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Detail
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-summary" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Summary
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-add-ons" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Add-ons
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-discount" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Discount
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                </nav>
            </div>
            
            <div class="flex justify-center mt-6">
                <div class="flex items-center space-x-4">
                    <select id="brand-dropdown" class="block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">-- Choose a Brand --</option>
                        <option value="brand1">Brand 1</option>
                        <option value="brand2">Brand 2</option>
                        <option value="brand3">Brand 3</option>
                    </select>
                    <div class="flex items-center space-x-1">
                        <label for="start-date" class="text-gray-700 text-sm">From:</label>
                        <input type="date" id="start-date" class="block px-4 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex items-center space-x-2">
                        <label for="end-date" class="text-gray-700 text-sm">To:</label>
                        <input type="date" id="end-date" class="block px-4 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <button class="px-4 py-1 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        Filter
                    </button>
                    <button class="px-4 py-1 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        Export
                    </button>
                </div>
            </div>
        </div>

        <div id="sale-detail" class="mt-6">
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Sale Detail</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600">Sale ID</th>
                            <th class="py-2 px-4 text-left text-gray-600">Shop</th>
                            <th class="py-2 px-4 text-left text-gray-600">Location</th>
                            <th class="py-2 px-4 text-left text-gray-600">Product Name (ENG)</th>
                            <th class="py-2 px-4 text-left text-gray-600">Product Name (KH)</th>
                            <th class="py-2 px-4 text-left text-gray-600">Add-ons</th>
                            <th class="py-2 px-4 text-left text-gray-600">Qty</th>
                            <th class="py-2 px-4 text-left text-gray-600">Price</th>
                            <th class="py-2 px-4 text-left text-gray-600">Currency ID</th>
                            <th class="py-2 px-4 text-left text-gray-600">Sale Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="py-2 px-4">1001</td>
                            <td class="py-2 px-4">HOMWTOWN</td>
                            <td class="py-2 px-4">SEKSOK</td>
                            <td class="py-2 px-4">Product A</td>
                            <td class="py-2 px-4">ផលិតផល A</td>
                            <td class="py-2 px-4">Sugar120%</td>
                            <td class="py-2 px-4">10</td>
                            <td class="py-2 px-4">$2</td>
                            <td class="py-2 px-4">USD</td>
                            <td class="py-2 px-4">06-09-2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="sale-summary" class="mt-6 hidden"></div>
        <div id="sale-add-ons" class="mt-6 hidden"></div>
        <div id="sale-discount" class="mt-6 hidden"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultTab = document.querySelector('nav a[href="#sale-detail"]');
        const defaultSection = document.querySelector('#sale-detail');

        if (defaultTab && defaultSection) {
            defaultTab.classList.add('text-blue-600');
            defaultTab.querySelector('span').classList.add('scale-x-100');
            defaultSection.classList.remove('hidden');
        }

        document.querySelectorAll('nav a').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('div[id^="sale-"]').forEach(section => {
                    section.classList.add('hidden');
                });
                document.querySelector(this.getAttribute('href')).classList.remove('hidden');
                
                document.querySelectorAll('nav a').forEach(a => {
                    a.classList.remove('text-blue-600');
                    a.querySelector('span').classList.remove('scale-x-100');
                });
                
                this.classList.add('text-blue-600');
                this.querySelector('span').classList.add('scale-x-100');
            });
        });
    });
</script>
@endsection
