<div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true"
    style="display:none"
    >
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak @click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

        <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-800 ">Filter by Date Range:</h1>

                <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>

            <form class="mt-5" action="" method="GET">
                <div>
                    <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Date from:</label>
                    <input type="date" id="date_from" name="date_from" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:outline-none focus:border-indigo-500" value="{{ $date_from ?? '' }}">
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Date to:</label>
                    <input type="date" id="date_to" name="date_to" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:outline-none focus:border-indigo-500" value="{{ $date_to ?? '' }}">
                </div>

                <div class="flex justify-end mt-6">
                    <x-primary-button>
                        Apply Filter
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
