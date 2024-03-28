<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($title) ? $title : '' }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid py-2">
                        <a href="{{ route('orders.create') }}" class="text-white w-32 text-center  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Order</a>
                    </div>
                    
                    <div class="grid py-2">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            User name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Created at
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                    @foreach($orders as $order)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $order->user->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $order->product_total }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $order->created_at }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('orders.view', $order) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4" colspan="4">
                                            No Order Found. Please Create a new one!    
                                        </td>
                                    </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>