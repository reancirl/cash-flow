<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Refilling') }}
        </h2>
    </x-slot>


    <div x-data="{ modelOpen: false }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="flex flex-col sm:flex-row">
                    <div class="flex flex-col mb-4 sm:mb-0 sm:mr-3 sm:w-1/5">
                        <div class="mb-2">
                            <a href="{{ route('transactions.create') }}?category=Refilling">
                                <x-primary-button class="">
                                    Add Transaction
                                </x-primary-button>
                            </a>
                        </div>
                        <div class="mb-2"">
                            <x-primary-button class="" @click="modelOpen =!modelOpen">
                                Date filter
                            </x-primary-button>
                        </div>
                        @if($date_from || $date_to || $request->type)
                            <div class="mb-2"">
                                <a href="{{ route('refilling') }}">
                                    <x-danger-button>
                                        Clear Filter
                                    </x-danger-button>
                                </a>
                            </div>    
                        @endif
                        <div class="mb-2">
                            <div
                                class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">₱
                                    {{ $sales ?? '0.00' }}</h5>
                                <p class="font-normal text-green-600 dark:text-gray-400">Sales</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div
                                class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">₱
                                    {{ $expense ?? '0.00' }}
                                </h5>
                                <p class="font-normal text-red-600 dark:text-gray-400">Expense</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg sm:w-4/5">
                        <div class="p-6 flex justify-between items-center">
                            <div class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                                Transactions List -
                                @if ($date_from || $date_to)
                                    @if($request->date_from == $request->date_to || $request->date_from == $today || $request->date_to == $today)
                                        {{ \Carbon\Carbon::parse($request->date_from)->format('F j') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($request->date_from)->format('F j') }} to 
                                        {{ \Carbon\Carbon::parse($request->date_to)->format('F j') }}
                                    @endif
                                @else
                                    Today
                                @endif
                            </div>
                            
                            <div class="dropdown">
                                <button class="dropdown-toggle">
                                    @if($request->type === 'sales')
                                        Sales only
                                    @elseif($request->type === 'expense')
                                        Expense only
                                    @else
                                        Select type
                                    @endif
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('refilling') }}{{$date_from || $date_to ? '?date_from='.$date_from.'&date_to='.$date_to.'&' : '?'}}type=">
                                        <div class="dropdown-item">All Type</div>
                                    </a>
                                    <a href="{{ route('refilling') }}{{$date_from || $date_to ? '?date_from='.$date_from.'&date_to='.$date_to.'&' : '?'}}type=sales">
                                        <div class="dropdown-item">Sales only</div>
                                    </a>
                                    <a href="{{ route('refilling') }}{{$date_from || $date_to ? '?date_from='.$date_from.'&date_to='.$date_to.'&' : '?'}}type=expense">
                                        <div class="dropdown-item">Expense only</div>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    
                        

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Reason/Description
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date - Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($data as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap {{ $item->in ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->in ? 'Sales' : 'Expense' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ₱ {{ $item->amount }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->description ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->created_at->format('F j (g:i A)') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('components.modal')
    </div>
</x-app-layout>
