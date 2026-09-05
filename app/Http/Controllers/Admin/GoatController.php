<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Goat;
use App\Models\GoatPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GoatController extends Controller
{
    public function index(Request $request)
    {
        $query = Goat::with([
            'breed',
            'photos'
        ]);

        // Cache breeds query - rarely changes
        $breeds = cache()->remember('active_breeds', 3600, function () {
            return Breed::where('status', 'active')
                ->orderBy('name')
                ->get();
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tag_number', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('color', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('breed_id')) {
            $query->where('breed_id', $request->breed_id);
        }

        $goats = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.goats.index', compact('goats', 'breeds'));
    }

    public function create()
    {
        $breeds = cache()->remember('active_breeds', 3600, function () {
            return Breed::where('status', 'active')
                ->orderBy('name')
                ->get();
        });

        return view('admin.goats.create', compact('breeds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag_number' => [
                'required',
                'string',
                'max:100',
                'unique:goats,tag_number',
            ],

            'name' => 'nullable|string|max:100',

            'breed_id' => 'required|exists:breeds,id',

            'category' => 'required|string|max:100',

            'gender' => [
                'required',
                Rule::in([
                    'male',
                    'female'
                ])
            ],

            'date_of_birth' => 'nullable|date',

            'color' => 'nullable|string|max:100',

            'weight' => 'nullable|numeric|min:0',

            'purchase_price' => 'nullable|numeric|min:0',

            'selling_price' => 'required|numeric|min:0',

            'location' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'featured' => 'nullable|boolean',

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'reserved',
                    'sold',
                    'archived'
                ])
            ],

            'photos.*' => 'nullable|image|max:5120',
        ]);

        $goat = Goat::create($validated);

        if ($request->hasFile('photos')) {

            foreach (
                $request->file('photos')
                as $index => $photo
            ) {

                $path = $photo->store(
                    'goats/' . $goat->id,
                    'public'
                );

                $goat->photos()->create([
                    'path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.goats.index')
            ->with(
                'success',
                'Goat added successfully.'
            );
    }

    public function show(Goat $goat)
    {
        $goat->load([
            'breed',
            'photos',
            'healthRecords',
            'weightRecords',
            'saleItems.sale.customer',
        ]);

        return view(
            'admin.goats.show',
            compact('goat')
        );
    }

    public function edit(Goat $goat)
    {
        $breeds = cache()->remember('active_breeds', 3600, function () {
            return Breed::where('status', 'active')
                ->orderBy('name')
                ->get();
        });

        $goat->load('photos');

        return view(
            'admin.goats.edit',
            compact(
                'goat',
                'breeds'
            )
        );
    }

    public function update(
        Request $request,
        Goat $goat
    ) {

        $validated = $request->validate([
            'tag_number' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'goats',
                    'tag_number'
                )->ignore($goat->id),
            ],

            'name' => 'nullable|string|max:100',

            'breed_id' => 'required|exists:breeds,id',

            'category' => 'required|string|max:100',

            'gender' => [
                'required',
                Rule::in([
                    'male',
                    'female'
                ])
            ],

            'date_of_birth' => 'nullable|date',

            'color' => 'nullable|string|max:100',

            'weight' => 'nullable|numeric|min:0',

            'purchase_price' => 'nullable|numeric|min:0',

            'selling_price' => 'required|numeric|min:0',

            'location' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'featured' => 'nullable|boolean',

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'reserved',
                    'sold',
                    'archived'
                ])
            ],

            'photos.*' => 'nullable|image|max:5120',
        ]);

        $goat->update($validated);

        if ($request->hasFile('photos')) {

            foreach (
                $request->file('photos')
                as $photo
            ) {

                $path = $photo->store(
                    'goats/' . $goat->id,
                    'public'
                );

                $goat->photos()->create([
                    'path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()
            ->route(
                'admin.goats.show',
                $goat
            )
            ->with(
                'success',
                'Goat updated successfully.'
            );
    }

    public function destroy(Goat $goat)
    {
        $goat->update([
            'status' => 'archived'
        ]);

        $goat->delete();

        return redirect()
            ->route('admin.goats.index')
            ->with(
                'success',
                'Goat archived successfully.'
            );
    }

    public function markSold(Goat $goat)
    {
        $goat->update([
            'status' => 'sold',
            'sold_at' => now(),
        ]);

        return back()->with(
            'success',
            'Goat marked as sold.'
        );
    }

    public function deletePhoto(
        GoatPhoto $photo
    ) {
        Storage::disk('public')
            ->delete($photo->path);

        $photo->delete();

        return back()->with(
            'success',
            'Photo deleted.'
        );
    }

    public function makePrimary(
        GoatPhoto $photo
    ) {
        $photo->goat
            ->photos()
            ->update([
                'is_primary' => false
            ]);

        $photo->update([
            'is_primary' => true
        ]);

        return back()->with(
            'success',
            'Primary photo updated.'
        );
    }
}