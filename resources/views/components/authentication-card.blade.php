<div class="h-[calc(100svh-72px)] xl:h-[calc(100svh-64px)] flex-1 flex flex-col">
    <div class="flex-1 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            {{ $logo }}
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>