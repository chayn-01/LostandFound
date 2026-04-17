<nav class="border-b backdrop-blur" style="border-color: var(--any-border); background-color: rgba(255,255,255,.88);">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-lg font-bold" style="color: var(--any-primary);">ANYwhere</a>
            <div class="hidden md:flex md:gap-4">
                <a href="{{ route('items.index') }}" class="text-sm {{ request()->routeIs('items.*') ? 'font-semibold' : '' }}" style="color: {{ request()->routeIs('items.*') ? 'var(--any-primary)' : 'var(--any-text-soft)' }};">My Reports</a>
                <a href="{{ route('items.public') }}" class="text-sm {{ request()->routeIs('items.public') ? 'font-semibold' : '' }}" style="color: {{ request()->routeIs('items.public') ? 'var(--any-primary)' : 'var(--any-text-soft)' }};">Browse Listings</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.items.index') }}" class="text-sm {{ request()->routeIs('admin.items.*') ? 'font-semibold' : '' }}" style="color: {{ request()->routeIs('admin.items.*') ? 'var(--any-primary)' : 'var(--any-text-soft)' }};">Admin Panel</a>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 text-sm">
            <span class="hidden sm:inline" style="color: var(--any-text-soft);">{{ auth()->user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="any-link">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="any-btn-primary px-3 py-2 font-medium">Logout</button>
            </form>
        </div>
    </div>
</nav>
