<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANYwhere - Ay! Nasaan na Yon!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="any-page">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl p-8 shadow-xl" style="background: linear-gradient(110deg, var(--any-primary) 0%, #4b8bb7 45%, var(--any-cyan) 100%); color: #fff;">
            <h1 class="text-4xl font-extrabold tracking-wide">ANYwhere</h1>
            <p class="mt-2 text-lg">Ay! Nasaan na Yon!</p>
            <div class="mt-6 flex gap-3">
                @auth
                    <a href="{{ route('items.index') }}" class="rounded-md bg-white px-4 py-2 font-semibold" style="color: var(--any-primary);">Open Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md bg-white px-4 py-2 font-semibold" style="color: var(--any-primary);">Log In</a>
                    <a href="{{ route('register') }}" class="rounded-md border border-white px-4 py-2 font-semibold text-white">Register</a>
                @endauth
            </div>
        </div>

        <div class="mt-8 flex items-center justify-between">
            <h2 class="text-xl font-bold" style="color: var(--any-text);">Recent Verified Listings</h2>
            <a href="{{ route('items.public') }}" class="text-sm font-semibold any-link">Browse all</a>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($items as $item)
                <article class="any-surface p-4">
                    <p class="text-xs font-semibold uppercase any-link">{{ $item->type }}</p>
                    <h3 class="mt-1 font-semibold">{{ $item->item_name }}</h3>
                    <p class="mt-2 text-sm" style="color: var(--any-text-soft);">{{ \Illuminate\Support\Str::limit($item->description, 90) }}</p>
                    <p class="mt-3 text-xs" style="color: var(--any-text-soft);">{{ $item->location }} • {{ $item->date_reported->format('M d, Y') }}</p>
                </article>
            @empty
                <p class="text-slate-500">No verified listings yet.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
