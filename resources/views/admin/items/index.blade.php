<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold" style="color: var(--any-text);">Admin Moderation Panel</h2>
            <x-back-link :href="route('items.index')" label="Back to Reports" />
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 rounded-md p-3 text-sm" style="background-color: var(--any-cyan); color: var(--any-text);">{{ session('status') }}</div>
        @endif

        <div class="grid gap-4 lg:grid-cols-2">
            @foreach($items as $item)
                <div class="any-surface p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase any-link">{{ $item->type }}</p>
                            <h3 class="text-lg font-semibold">{{ $item->item_name }}</h3>
                            <p class="text-xs" style="color: var(--any-text-soft);">Posted by {{ $item->user->name }} ({{ $item->user->email }})</p>
                        </div>
                        <span class="rounded-full px-2 py-1 text-xs" style="background-color: var(--any-mint); color: var(--any-text-soft);">{{ ucfirst($item->status) }}</span>
                    </div>

                    <p class="mt-3 text-sm" style="color: var(--any-text-soft);">{{ $item->description }}</p>
                    <p class="mt-2 text-xs" style="color: var(--any-text-soft);">{{ $item->location }} • {{ $item->date_reported->format('M d, Y') }}</p>

                    <form method="POST" action="{{ route('admin.items.update', $item) }}" class="mt-4 flex flex-wrap items-center gap-3">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="rounded-md text-sm" style="border-color: var(--any-border);">
                            @foreach(['pending', 'claimed', 'resolved'] as $state)
                                <option value="{{ $state }}" @selected($item->status === $state)>{{ ucfirst($state) }}</option>
                            @endforeach
                        </select>
                        <select name="is_verified" class="rounded-md text-sm" style="border-color: var(--any-border);">
                            <option value="1" @selected($item->is_verified)>Verified</option>
                            <option value="0" @selected(!$item->is_verified)>Not Verified</option>
                        </select>
                        <button class="any-btn-primary px-3 py-2">Save</button>
                    </form>

                    <form method="POST" action="{{ route('admin.items.destroy', $item) }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm text-rose-600" onclick="return confirm('Remove this report?')">Delete Report</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $items->links() }}</div>
    </div>
</x-app-layout>
