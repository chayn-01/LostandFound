<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold" style="color: var(--any-text);">Edit Item Report</h2>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="any-surface p-6">
            <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('items._form', ['item' => $item])
            </form>
        </div>
    </div>
</x-app-layout>
