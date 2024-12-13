<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Call Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div>
                    <h4 class="text-lg bg-blue-600 text-white font-medium rounded-md py-10">{{ session('success') }}</h4>
                </div>
            @endif

            <h3 class="text-lg text-white font-medium mt-6">Call Center Order Form</h3>

            <!-- User Selection and Order Form -->
            <form action="{{ route('call-center.store-order') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <!-- user -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- address -->
                    <label for="address" class="block text-sm font-medium text-white">Shipping Address</label>
                    <input type="text" name="address" id="address"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('address') }}">

                    <!-- Product Selection and Quantity -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700">Select Products</h4>
                        @foreach ($products as $product)
                            <div class="flex items-center space-x-4 mt-2">
                                <!-- Product Checkbox -->
                                <input type="checkbox" name="products[{{ $product->id }}][product_id]"
                                    value="{{ $product->id }}" class="form-checkbox"
                                    @if (old('products.' . $product->id . '.product_id')) checked @endif id="product-{{ $product->id }}"
                                    onchange="toggleQuantityInput({{ $product->id }})">

                                <label class="text-white">{{ $product->name }} ({{ "$" . $product->price }})</label>

                                <!-- Quantity Input -->
                                <input type="number" name="products[{{ $product->id }}][quantity]"
                                    value="{{ old('products.' . $product->id . '.quantity', 0) }}"
                                    class="w-16 border border-gray-300 rounded-md px-2 py-1"
                                    id="quantity-{{ $product->id }}"
                                    {{ !old('products.' . $product->id . '.product_id') ? 'disabled' : '' }}>
                            </div>
                        @endforeach
                        @error('products')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        function toggleQuantityInput(productId) {
                            const checkbox = document.getElementById('product-' + productId);
                            const quantityInput = document.getElementById('quantity-' + productId);

                            if (checkbox.checked) {
                                quantityInput.disabled = false;
                            } else {
                                quantityInput.disabled = true;
                                quantityInput.value = 0;
                            }
                        }
                    </script>

                    <div>
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Place Order
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
