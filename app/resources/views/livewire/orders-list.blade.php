{{--https://flowbite.com/docs/components/tables/#table-foot--}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4">
        <div>
            <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                </svg>
                Items per Page
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow " data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                    @foreach($itemsPerPageList as $value)
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input wire:model="itemsPerPage"
                                   type="radio"
                                   id="itemsPerPage-{{ $value }}"
                                   value="{{$value}}"
                                   name="itemsPerPage-{{ $value }}"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="itemsPerPage-{{ $value }}"
                                   class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                {{$value}} items
                            </label>
                        </div>

                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5">Total items {{$orders->count()}}</div>

        <div class="relative mt-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" wire:model="searchFields" id="table-search"
                   class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 dark:border-gray-600 dark:placeholder-gray-400"
                   placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm text-left border-gray-200 bg-gray-100 text-gray-700">
        <thead>
        <tr>
            @foreach(['id','order_ref','customer_name','product_name','qty','cost', 'total_cost'] as $element)
                <th scope="col" class="px-6 py-3 cursor-pointer"
                    wire:click="sortClick('{{$element}}')">
                    <div class="flex items-center">
                        {{ ucwords(str_replace('_', ' ', $element)) }}
                        @if($sortElement === $element)
                            @if($sortType === 'asc')
                                <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M5 1v12m0 0 4-4m-4 4L1 9"/>
                                </svg>
                            @else
                                <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                                </svg>
                            @endif
                        @else
                            <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                            </svg>
                        @endif
                    </div>
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @if(!$orders->count())
            <tr>
                <td colspan="7" class="text-center">
                    <div>No se encontraron resultados</div>
                </td>
            </tr>
        @else
            @foreach($orders as $order)
                <tr class="bg-white border-b">
                    @foreach($order->getAttributes() as $column => $value)
                        <td class="px-6 py-4">
                            {{ $value }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-center">
                    <div class="text-center">
                        {{$orders->links()}}
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
