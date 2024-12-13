<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg text-white font-medium mt-6">Get Customer Information</h3>

            <!-- user -->
            <form action="{{ route('orders.search') }}" method="GET">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Select Customer</label>
                        <select name="user_id" id="user_id"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All customers</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- results -->
            @if (isset($orders) && $orders->isNotEmpty())
                <table class="min-w-full bg-white border border-gray-200 mt-6">
                    <thead>
                        <tr>
                            <th class="p-2 border-b text-left">Customer Name</th>
                            <th class="p-2 border-b text-left">Tracking Number</th>
                            <th class="p-2 border-b text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="p-2 border-b">{{ $order->customer_name }}</td> <!-- Customer Name -->
                                <td class="p-2 border-b">{{ $order->tracking_number }}</td>
                                <td class="p-2 border-b">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-white">No orders found for the selected customer.</p>
            @endif
        </div>
    </div>
</x-app-layout>
