<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANYwhere Listings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-4">
            <x-back-link :href="url()->previous()" label="Back" />
        </div>
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-lg font-bold text-indigo-700">ANYwhere</a>
            <div class="text-sm">
                @auth
                    <a href="{{ route('items.index') }}" class="text-indigo-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600">Log in</a>
                @endauth
            </div>
        </div>

        <h1 class="text-2xl font-bold">Public Lost & Found Listings</h1>
        <p class="mt-2 text-sm text-slate-600">Verified posts curated by administrators.</p>

        <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($items as $item)
                <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase text-indigo-600">{{ $item->type }}</p>
                    <h2 class="mt-1 text-lg font-semibold">{{ $item->item_name }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                    <p class="mt-3 text-xs text-slate-500">{{ $item->location }} • {{ $item->date_reported->format('M d, Y') }}</p>
                </article>
            @empty
                <p class="text-slate-500">No verified listings yet.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $items->links() }}</div>
    </div>
</body>
</html>
