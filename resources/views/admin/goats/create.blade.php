@extends('admin.layouts.app')

@section('title', 'Add Goat')
@section('page-title', 'Add Goat')

@section('content')

<div class="max-w-4xl">

    <div class="bg-white rounded-xl border shadow-sm p-6">

        <form action="{{ route('admin.goats.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block font-semibold mb-2">Tag Number <span class="text-red-500">*</span></label>
                    <input type="text" name="tag_number" value="{{ old('tag_number') }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('tag_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Breed <span class="text-red-500">*</span></label>
                    <select name="breed_id" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="">Select Breed</option>
                        @foreach($breeds as $breed)
                            <option value="{{ $breed->id }}" {{ old('breed_id') == $breed->id ? 'selected' : '' }}>{{ $breed->name }}</option>
                        @endforeach
                    </select>
                    @error('breed_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Category <span class="text-red-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category') }}" required placeholder="e.g. Dairy, Meat, Breeding" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Gender <span class="text-red-500">*</span></label>
                    <select name="gender" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('date_of_birth')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('weight')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Purchase Price (KES)</label>
                    <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('purchase_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Selling Price (KES) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('selling_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="reserved" {{ old('status') === 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

            </div>

            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Photos</label>
                <input type="file" name="photos[]" multiple accept="image/*" class="w-full border rounded-lg px-4 py-3">
                <p class="text-xs text-gray-500 mt-1">Upload multiple photos. First photo will be primary.</p>
                @error('photos.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="featured" value="1" id="featured" {{ old('featured') ? 'checked' : '' }} class="rounded">
                <label for="featured" class="font-semibold">Featured goat</label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold hover:bg-green-800">
                    <i class="fa-solid fa-save mr-2"></i>Save Goat
                </button>
                <a href="{{ route('admin.goats.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection