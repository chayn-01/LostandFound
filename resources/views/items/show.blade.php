<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-800">Report Details</h2>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase text-indigo-600">{{ $item->type }}</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">{{ $item->item_name }}</h1>
            <p class="mt-3 text-slate-600">{{ $item->description }}</p>
            <div class="mt-4 grid gap-2 text-sm text-slate-500 sm:grid-cols-2">
                <p><span class="font-medium text-slate-700">Location:</span> {{ $item->location }}</p>
                <p><span class="font-medium text-slate-700">Date:</span> {{ $item->date_reported->format('M d, Y') }}</p>
                <p><span class="font-medium text-slate-700">Status:</span> {{ ucfirst($item->status) }}</p>
                <p><span class="font-medium text-slate-700">Verified:</span> {{ $item->is_verified ? 'Yes' : 'No' }}</p>
            </div>
            @if($item->image_path)
                <img src="{{ asset('storage/'.$item->image_path) }}" alt="Item image" class="mt-5 w-full rounded-lg border border-slate-200 object-cover" />
            @endif
        </article>
    </div>
</x-app-layout>
