<div
    x-data="{ open: $wire.entangle('open') }"
    @toggle-create-receipt.window="open = ($event.detail && 'open' in $event.detail) ? $event.detail.open : true; open ? $wire.open() : $wire.close()"
    x-cloak
>
    <!-- Overlay -->
    <div
        class="fixed inset-0 z-40 bg-black/30 backdrop-blur-[1px]"
        x-show="open"
        x-transition.opacity
        @click="$wire.close()"
    ></div>

    <!-- Flyout Panel -->
    <div
        class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-white dark:bg-neutral-900 border-l border-neutral-200 dark:border-neutral-800 shadow-xl flex flex-col"
        x-show="open"
        x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-neutral-200 dark:border-neutral-800">
            <h3 class="text-lg font-semibold text-pink-500">New Receipt</h3>
            <button type="button" class="p-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-800" @click="$wire.close()" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-pink-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto p-4">
            <form wire:submit.prevent="create" class="space-y-4">
                <div>
                    <label for="title" class="block text-xs uppercase tracking-wide mb-1 text-pink-500">Title</label>
                    <input id="title" type="text" wire:model.defer="title"
                           class="w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-pink-500 focus:ring-pink-500 focus:border-pink-500 mt-2 p-2"
                           placeholder="e.g. Fix modal on mobile" />
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-xs uppercase tracking-wide mb-1 text-pink-500">Description</label>
                    <textarea id="description" rows="4" wire:model.defer="description"
                              class="w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-pink-500 focus:ring-pink-500 focus:border-pink-500 mt-2 p-2"
                              placeholder="The modal currently doesn't show..."></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" class="px-4 py-2 rounded-md border border-neutral-300 dark:border-neutral-700 text-pink-500 hover:bg-neutral-100 dark:hover:bg-neutral-800" wire:click="close">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-pink-500 text-white hover:bg-pink-600 disabled:opacity-50" wire:loading.attr="disabled">
                        <span wire:loading.remove>Create</span>
                        <span wire:loading>Creating...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
