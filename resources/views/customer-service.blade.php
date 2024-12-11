<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Service - Inventory Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search Form -->
            <form action="{{ route('customer-service.search') }}" method="POST">
                @csrf
                <div class="flex space-x-4">
                    <!-- Product Name Input -->
                    <div class="w-1/3">
                        <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="product_name" id="product_name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('product_name') }}">
                    </div>

                    <!-- Store Select Dropdown -->
                    <div class="w-1/3">
                        <label for="store_id" class="block text-sm font-medium text-gray-700">Store</label>
                        <select name="store_id" id="store_id"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Stores</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table for displaying search results -->
            @if(isset($products) && $products->isNotEmpty())
                <h3 class="text-lg font-medium mt-6">Inventory Search Results</h3>
                <table class="min-w-full table-auto mt-4 border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b">Store Name</th>
                            <th class="px-4 py-2 text-left border-b">Product Name</th>
                            <th class="px-4 py-2 text-left border-b">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            @foreach($product->inventories as $inventory)
                                @if($inventory->quantity > 0)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 border-b">
                                            @if($inventory->store)
                                                {{ $inventory->store->name }} <!-- Store Name -->
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border-b">{{ $product->name }}</td> <!-- Product Name -->
                                        <td class="px-4 py-2 border-b">{{ $inventory->quantity }}</td> <!-- Quantity -->
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @elseif(isset($products) && $products->isEmpty())
                <p>No products found based on your search criteria.</p>
            @else
                <p>No search results yet. Please enter a search term above.</p>
            @endif
        </div>
    </div>
</x-app-layout>
