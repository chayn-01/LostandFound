<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemModerationController extends Controller
{
    public function index()
    {
        return view('admin.items.index', [
            'items' => Item::with('user')->latest()->paginate(12),
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,claimed,resolved'],
            'is_verified' => ['required', 'boolean'],
        ]);

        $item->update($data);

        return back()->with('status', 'Item moderation changes saved.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return back()->with('status', 'Item removed by administrator.');
    }
}
