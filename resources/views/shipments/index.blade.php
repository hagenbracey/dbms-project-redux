<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shipments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg text-white font-medium mt-6">Search Shipments</h3>

            <!-- warehouse -->
            <form action="{{ route('shipments.search') }}" method="GET">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="warehouse_id" class="block text-sm font-medium text-gray-700">Select Warehouse</label>
                        <select name="warehouse_id" id="warehouse_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All warehouses</option>
                            @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- results -->
            @if(isset($shipments) && $shipments->isNotEmpty())
            <table class="min-w-full bg-white border border-gray-200 mt-6">
                <thead>
                    <tr>
                        <th class="p-2 border-b text-left">Shipment ID</th>
                        <th class="p-2 border-b text-left">Tracking Number</th>
                        <th class="p-2 border-b text-left">Status</th>
                        <th class="p-2 border-b text-left">Product Name</th>
                        <th class="p-2 border-b text-left">Quantity</th>
                        <th class="p-2 border-b text-left">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shipments as $shipment)
                    <tr>
                        <td class="p-2 border-b">{{ $shipment->shipment_id }}</td>
                        <td class="p-2 border-b">{{ $shipment->tracking_number }}</td>
                        <td class="p-2 border-b">{{ $shipment->status }}</td>
                        <td class="p-2 border-b">{{ $shipment->product_name }}</td>
                        <td class="p-2 border-b">{{ $shipment->quantity }}</td>
                        <td class="p-2 border-b">{{ $shipment->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-white">No shipments found for the selected warehouse.</p>
            @endif
        </div>
    </div>
</x-app-layout>