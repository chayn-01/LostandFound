<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('user')
            ->when(! $request->user()->isAdmin(), function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })
            ->latest();

        return view('items.index', [
            'items' => $query->paginate(10),
        ]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:lost,found'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'date_reported' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['user_id'] = $request->user()->id;
        $data['image_path'] = $request->file('image')?->store('items', 'public');

        Item::create($data);

        return redirect()->route('items.index')->with('status', 'Item report created.');
    }

    public function show(Item $item)
    {
        $this->authorizeItem($item);

        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorizeItem($item);

        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorizeItem($item);

        $data = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:lost,found'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'date_reported' => ['required', 'date'],
            'status' => ['nullable', 'in:pending,claimed,resolved'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('items', 'public');
        }

        if (! $request->user()->isAdmin()) {
            unset($data['status']);
        }

        $item->update($data);

        return redirect()->route('items.index')->with('status', 'Item report updated.');
    }

    public function destroy(Request $request, Item $item)
    {
        $this->authorizeItem($item);

        $item->delete();

        return redirect()->route('items.index')->with('status', 'Item report deleted.');
    }

    private function authorizeItem(Item $item): void
    {
        if (auth()->user()->isAdmin()) {
            return;
        }

        abort_if($item->user_id !== auth()->id(), 403, 'Unauthorized action.');
    }
}
