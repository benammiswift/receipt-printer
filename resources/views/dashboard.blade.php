@use('App\Enums\Timeframe')
@use('App\Helpers\DashboardHelper')
@use('App\Models\Receipt')
<x-layouts.app :title="__('Dashboard')">
    <div
        class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl"
        x-data
        @keydown.window="
            const k = $event.key;
            const tag = ($event.target && $event.target.tagName) ? $event.target.tagName.toUpperCase() : '';
            const isFormField = ['INPUT','TEXTAREA','SELECT'].includes(tag) || ($event.target && $event.target.isContentEditable);
            if (!isFormField && (k === 'c' || k === 'C') && !$event.metaKey && !$event.ctrlKey && !$event.altKey) {
                $event.preventDefault();
                window.dispatchEvent(new CustomEvent('toggle-create-receipt', { detail: { open: true } }))
            }
        "
    >
        <div class="flex items-center justify-between">
            <div class="grid flex-1 auto-rows-min gap-4 md:grid-cols-3 text-pink-500">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="flex items-end justify-center space-x-4">
                            <div
                                class="text-8xl font-semibold">{{ DashboardHelper::getDashboardCount(Timeframe::THIS_WEEK) }}</div>
                            <div class="text-3xl mb-3">This week</div>
                        </div>
                    </div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="flex items-end justify-center space-x-4">
                            <div class="text-8xl font-semibold">{{ DashboardHelper::getDashboardCount(Timeframe::THIS_MONTH) }}</div>
                            <div class="text-3xl mb-3">This month</div>
                        </div>
                    </div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="flex items-end justify-center space-x-4">
                            <div class="text-8xl font-semibold">{{ DashboardHelper::getDashboardCount(Timeframe::ALL_TIME) }}</div>
                            <div class="text-3xl mb-3">All time</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="absolute inset-0 overflow-y-auto">
                <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                    <thead class="bg-neutral-50 dark:bg-neutral-800/50 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-pink-500">Created</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-pink-500">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-pink-500">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                        @php($receipts = Receipt::query()->orderByDesc('created_at')->get())
                        @forelse($receipts as $receipt)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/40">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-pink-500">{{ optional($receipt->created_at)->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-pink-500">{{ $receipt->title }}</td>
                                <td class="px-4 py-3 text-sm text-pink-500">{{ $receipt->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">No receipts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Small side button to open the flyout -->
        <button
            type="button"
            class="fixed right-4 top-1/2 -translate-y-1/2 z-30 rounded-full bg-pink-500 p-3 text-white shadow-lg hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500"
            x-data
            @click="window.dispatchEvent(new CustomEvent('toggle-create-receipt', { detail: { open: true } }))"
            aria-label="Open new receipt flyout"
            title="New Receipt"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>

        <livewire:receipts.create-receipt />
    </div>
</x-layouts.app>
