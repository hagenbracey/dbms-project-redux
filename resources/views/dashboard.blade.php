<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- customer service page -->
                <div
                    class="bg-blue-950 text-white p-6 rounded-lg shadow-lg hover:bg-blue-600 transition flex items-center justify-center">
                    <a href="{{ route('customer-service') }}" class="block text-center">
                        <h3 class="text-lg font-semibold">Customer Service</h3>
                        <p class="mt-2">Check inventory at stores and warehouses.</p>
                        <img src="{{ asset('svg/customer-service.svg') }}" alt="" class="mx-auto">
                    </a>
                </div>

                <!-- call center -->
                <div
                    class="bg-blue-950 text-white p-6 rounded-lg shadow-lg hover:bg-blue-600 transition flex items-center justify-center">
                    <a href="{{ route('call-center') }}" class="block text-center">
                        <h3 class="text-lg font-semibold">Call Center</h3>
                        <p class="mt-2">Place phone orders.</p>
                        <img src="{{ asset('svg/call-center.svg') }}" alt="" class="mx-auto">
                    </a>
                </div>

                <!-- shipments -->
                <div
                    class="bg-blue-950 text-white p-6 rounded-lg shadow-lg hover:bg-blue-600 transition flex items-center justify-center">
                    <a href="{{ route('shipments') }}" class="block text-center">
                        <h3 class="text-lg font-semibold">Warehouse Clerks</h3>
                        <p class="mt-2">Check shipment information.</p>
                        <img src="{{ asset('svg/warehouse.svg') }}" alt="" class="mx-auto">
                    </a>
                </div>

                <!-- orders -->
                <div
                    class="bg-blue-950 text-white p-6 rounded-lg shadow-lg hover:bg-blue-600 transition flex items-center justify-center">
                    <a href="{{ route('orders') }}" class="block text-center">
                        <h3 class="text-lg font-semibold">Customers</h3>
                        <p class="mt-2">Pull a customer's information and orders.</p>
                        <img src="{{ asset('svg/orders.svg') }}" alt="" class="mx-auto">
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
