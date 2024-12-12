<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Service - Inventory Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('customer-service.search') }}" method="POST">
                @csrf
                <div class="flex space-x-4">
                    <!-- product name -->
                    <div class="w-1/3">
                        <label for="product_name" class="block text-sm font-medium text-white">Product Name</label>
                        <input type="text" name="product_name" id="product_name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('product_name') }}">
                    </div>

                    <!-- store -->
                    <div class="w-1/3">
                        <label for="store_id" class="block text-sm font-medium text-white">Store</label>
                        <select name="store_id" id="store_id"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Stores</option>
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}">
                                {{ $store->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- submit -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- results -->
            @if(isset($products) && $products->isNotEmpty())
            <table class="min-w-full bg-white border border-gray-200 mt-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border-b">Store Name</th>
                        <th class="px-4 py-2 text-left border-b">Product Name</th>
                        <th class="px-4 py-2 text-left border-b">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $product->store_name }}</td>
                        <td class="px-4 py-2 border-b">{{ $product->product_name }}</td>
                        <td class="px-4 py-2 border-b">{{ $product->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(isset($products) && $products->isEmpty())
            <p>No products found based on your search criteria.</p>
            @else
            <p class="text-white">No search results yet. Please input a product name and/or select a store and click "Search".</p>
            @endif
        </div>
    </div>
</x-app-layout>