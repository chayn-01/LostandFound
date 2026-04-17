<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold" style="color: var(--any-text);">Create Item Report</h2>
            <a href="{{ route('items.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">← Back to Reports</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="any-surface p-6">
            <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                @csrf
                @include('items._form')
            </form>
        </div>
    </div>
</x-app-layout>
