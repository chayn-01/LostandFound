@php($editing = isset($item))

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Item Name</label>
        <input name="item_name" value="{{ old('item_name', $item->item_name ?? '') }}" required class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);" />
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Type</label>
        <select name="type" class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);">
            <option value="lost" @selected(old('type', $item->type ?? '') === 'lost')>Lost</option>
            <option value="found" @selected(old('type', $item->type ?? '') === 'found')>Found</option>
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-slate-700">Date</label>
        <input type="date" name="date_reported" value="{{ old('date_reported', isset($item) ? $item->date_reported?->format('Y-m-d') : '') }}" required class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);" />
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Location</label>
        <input name="location" value="{{ old('location', $item->location ?? '') }}" required class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);" />
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Description</label>
        <textarea name="description" rows="4" class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);" required>{{ old('description', $item->description ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-slate-700">Image (optional)</label>
        <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);" />
    </div>
    @if($editing && auth()->user()->isAdmin())
        <div>
            <label class="text-sm font-medium text-slate-700">Status</label>
            <select name="status" class="mt-1 w-full rounded-md text-sm" style="border-color: var(--any-border);">
                @foreach(['pending', 'claimed', 'resolved'] as $state)
                    <option value="{{ $state }}" @selected(old('status', $item->status) === $state)>{{ ucfirst($state) }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

<div class="mt-6 flex items-center gap-3">
    <button class="any-btn-primary">{{ $editing ? 'Update Report' : 'Submit Report' }}</button>
    <a href="{{ route('items.index') }}" class="text-sm text-slate-600">Cancel</a>
</div>
