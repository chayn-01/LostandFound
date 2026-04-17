<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold" style="color: var(--any-text);">My Lost and Found Reports</h2>
            <a href="{{ route('items.create') }}" class="any-btn-primary">+ New Report</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 rounded-md p-3 text-sm" style="background-color: var(--any-cyan); color: var(--any-text);">{{ session('status') }}</div>
        @endif

        <div class="any-surface overflow-hidden">
            <table class="min-w-full text-sm">
                <thead style="background-color: var(--any-mint);">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold" style="color: var(--any-text);">Item</th>
                        <th class="px-4 py-3 text-left font-semibold" style="color: var(--any-text);">Type</th>
                        <th class="px-4 py-3 text-left font-semibold" style="color: var(--any-text);">Status</th>
                        <th class="px-4 py-3 text-left font-semibold" style="color: var(--any-text);">Date</th>
                        <th class="px-4 py-3 text-left font-semibold" style="color: var(--any-text);">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="--tw-divide-opacity:1; border-color: var(--any-border);">
                    @forelse($items as $item)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="font-semibold" style="color: var(--any-text);">{{ $item->item_name }}</p>
                                <p class="text-xs" style="color: var(--any-text-soft);">{{ $item->location }}</p>
                            </td>
                            <td class="px-4 py-3 capitalize">{{ $item->type }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span class="rounded-full px-2 py-1 text-xs font-medium" style="background-color: var(--any-cyan); color: var(--any-text);">{{ $item->status }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $item->date_reported->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('items.show', $item) }}" class="any-link">View</a>
                                    <a href="{{ route('items.edit', $item) }}" style="color: var(--any-text-soft);">Edit</a>
                                    <form method="POST" action="{{ route('items.destroy', $item) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-rose-600" onclick="return confirm('Delete this report?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-slate-500">No reports yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</x-app-layout>
