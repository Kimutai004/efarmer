<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function index(Request $request)
    {
        $query = Breed::withCount('goats');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $breeds = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.breeds.index', compact('breeds'));
    }

    public function create()
    {
        return view('admin.breeds.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:breeds,name',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Breed::create($data);

        return redirect()
            ->route('admin.breeds.index')
            ->with('success', 'Breed created successfully.');
    }

    public function edit(Breed $breed)
    {
        return view('admin.breeds.edit', compact('breed'));
    }

    public function update(Request $request, Breed $breed)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:breeds,name,' . $breed->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $breed->update($data);

        return redirect()
            ->route('admin.breeds.index')
            ->with('success', 'Breed updated successfully.');
    }

    public function destroy(Breed $breed)
    {
        if ($breed->goats()->exists()) {
            return back()->with('error', 'Breed has goats and cannot be deleted.');
        }

        $breed->delete();

        return back()->with('success', 'Breed deleted.');
    }
}