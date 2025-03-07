<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
            <div class="p-6 bg-white shadow-lg rounded-xl text-gray-900 dark:bg-gray-800 dark:text-white">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-purple-500">Total Admissions</h3>
                        <p class="text-4xl font-semibold text-purple-500">1,500</p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-xl text-gray-900 dark:bg-gray-800 dark:text-white">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-blue-500">Total Students</h3>
                        <p class="text-4xl font-semibold text-blue-500">1,250</p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-xl text-gray-900 dark:bg-gray-800 dark:text-white">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-green-500">Total Staffs</h3>
                        <p class="text-4xl font-semibold text-green-500">200</p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-xl text-gray-900 dark:bg-gray-800 dark:text-white">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12v-.008z" />
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-orange-500">Total Faculties</h3>
                        <p class="text-4xl font-semibold text-orange-500">12</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
