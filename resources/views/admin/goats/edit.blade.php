@extends('admin.layouts.app')

@section('title', 'Edit Goat')
@section('page-title', 'Edit Goat')

@section('content')

<div class="max-w-4xl">

    <div class="bg-white rounded-xl border shadow-sm p-6">

        <form action="{{ route('admin.goats.update', $goat) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block font-semibold mb-2">Tag Number <span class="text-red-500">*</span></label>
                    <input type="text" name="tag_number" value="{{ old('tag_number', $goat->tag_number) }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('tag_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $goat->name) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Breed <span class="text-red-500">*</span></label>
                    <select name="breed_id" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="">Select Breed</option>
                        @foreach($breeds as $breed)
                            <option value="{{ $breed->id }}" {{ old('breed_id', $goat->breed_id) == $breed->id ? 'selected' : '' }}>{{ $breed->name }}</option>
                        @endforeach
                    </select>
                    @error('breed_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Category <span class="text-red-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category', $goat->category) }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Gender <span class="text-red-500">*</span></label>
                    <select name="gender" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="male" {{ old('gender', $goat->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $goat->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $goat->date_of_birth?->format('Y-m-d')) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('date_of_birth')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Color</label>
                    <input type="text" name="color" value="{{ old('color', $goat->color) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" value="{{ old('weight', $goat->weight) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('weight')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Purchase Price (KES)</label>
                    <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price', $goat->purchase_price) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('purchase_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Selling Price (KES) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price', $goat->selling_price) }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('selling_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $goat->location) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="available" {{ old('status', $goat->status) === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="reserved" {{ old('status', $goat->status) === 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="sold" {{ old('status', $goat->status) === 'sold' ? 'selected' : '' }}>Sold</option>
                        <option value="archived" {{ old('status', $goat->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

            </div>

            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">{{ old('description', $goat->description) }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Existing Photos -->
            @if($goat->photos->count() > 0)
                <div>
                    <label class="block font-semibold mb-2">Current Photos</label>
                    <div class="flex gap-3 flex-wrap">
                        @foreach($goat->photos as $photo)
                            <div class="relative group">
                                <img src="{{ asset('storage/'.$photo->path) }}" class="w-24 h-24 rounded-lg object-cover">
                                @if($photo->is_primary)
                                    <span class="absolute top-1 left-1 bg-green-600 text-white text-[10px] px-2 py-0.5 rounded">Primary</span>
                                @endif
                                <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition">
                                    @if(!$photo->is_primary)
                                        <form action="{{ route('admin.goat-photos.primary', $photo) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-white text-xs bg-green-600 px-2 py-1 rounded">Make Primary</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.goat-photos.destroy', $photo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white text-xs bg-red-600 px-2 py-1 rounded">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif>

            <div>
                <label class="block font-semibold mb-2">Add More Photos</label>
                <input type="file" name="photos[]" multiple accept="image/*" class="w-full border rounded-lg px-4 py-3">
                @error('photos.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="featured" value="1" id="featured" {{ old('featured', $goat->featured) ? 'checked' : '' }} class="rounded">
                <label for="featured" class="font-semibold">Featured goat</label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold hover:bg-green-800">
                    <i class="fa-solid fa-save mr-2"></i>Update Goat
                </button>
                <a href="{{ route('admin.goats.show', $goat) }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection