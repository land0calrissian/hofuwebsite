<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // Display a listing of the items
    public function index()
    {
        $items = Item::all();
        return view('index', compact('items'));
    }
    public function dashboard(Request $request)
    {
        $query = $request->input('query');
        $category = $request->query('category');
    
        // Start with a base query
        $itemsQuery = Item::query();
    
        // Apply search filter if query is present
        if ($query) {
            $itemsQuery->where('name', 'LIKE', "%$query%");
        }
    
        // Apply category filter if category is present
        if ($category) {
            $itemsQuery->where('category', $category);
        }
    
        // Get the filtered items
        $items = $itemsQuery->get();
    
        // Manually define categories
        $categories = [
            ['id' => 1, 'name' => 'Coffee', 'count' => Item::where('category', 1)->count()],
            ['id' => 2, 'name' => 'Non-coffee', 'count' => Item::where('category', 2)->count()],
            ['id' => 3, 'name' => 'Food', 'count' => Item::where('category', 3)->count()],
        ];
    
        return view('shop', compact('items', 'categories', 'query', 'category'));
    }

    // Show the form for creating a new item
    public function create()
    {
        return view('create');
    }

    // Store a newly created item in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category' => 'required|integer',
        ]);
       // dd($request->all());
        $data = $request->all();
        $data['status'] = 1;//active
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('images', 'public');
            $data['image'] = $imageName;
        }

  
        Item::create($data);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

  
    // Show the form for editing the specified item
    public function edit(Item $item)
    {
        return view('edit', compact('item'));
    }

    // Update the specified item in storage
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'sometimes|required|numeric',
            'category' => 'sometimes|required|integer',
        ]);
      //  dd($request->all());
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
    
            $imageName = $request->file('image')->store('images', 'public');
            $data['image'] = $imageName;
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // Remove the specified item from storage
    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
    
        $item->delete();
        

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    // Change the status of the specified item
    public function updateStatus(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->status = $request->status;
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item status updated successfully.');
    }
}