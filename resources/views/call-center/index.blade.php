<!-- resources/views/call-center/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Call Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg text-white font-medium mt-6">Call Center Order Form</h3>

            <!-- Display success message with tracking number -->
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Selection and Order Form -->
            <form action="{{ route('call-center.store-order') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <!-- User Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select a user</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Product Selection and Quantity -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700">Select Products</h4>
                        @foreach($products as $product)
                            <div class="flex items-center space-x-4 mt-2">
                                <input type="checkbox" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}" class="form-checkbox">
                                <label class="text-white">{{ $product->name }} ({{"$". $product->price }})</label>
                                <input type="number" name="products[{{ $product->id }}][quantity]" value="1" class="w-16 border border-gray-300 rounded-md px-2 py-1">
                            </div>
                        @endforeach
                        @error('products')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Place Order
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
