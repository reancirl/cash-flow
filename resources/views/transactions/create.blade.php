<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Transaction for') }} {{ $request->category ?? 'N/A' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4 text-red-600" :status="session('status')" />
            <form action="{{ route('transactions.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
                @csrf
                <input type="hidden" name="category" value="{{$request->category ?? ''}}">
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="in" id="type" required
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="1">Sales</option>
                        <option value="0">Expense</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" id="amount" required
                        class="block w-full mt-1 p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                @if($request->category === 'Laundry') 
                    <div class="mb-4">
                        <label for="fold" class="block text-sm font-medium text-gray-700 mb-2">Number of Folds</label>
                        <input type="number" name="folds" id="folds" required
                            class="block w-full mt-1 p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                @endif

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <input type="text" name="description" id="description"
                        class="block w-full mt-1 p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <x-primary-button class="w-full sm:w-auto">
                    Save
                </x-primary-button>

            </form>
        </div>
    </div>

</x-app-layout>
