<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3 text-pink-500">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="flex items-end justify-center space-x-4">
                    <div class="text-8xl font-semibold">10</div>
                    <div class="text-3xl mb-3">This week</div>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="flex items-end justify-center space-x-4">
                        <div class="text-8xl font-semibold">10</div>
                        <div class="text-3xl mb-3">This month</div>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="flex items-end justify-center space-x-4">
                        <div class="text-8xl font-semibold">10</div>
                        <div class="text-3xl mb-3">All time</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
