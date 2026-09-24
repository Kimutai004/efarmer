@extends('admin.layouts.app')

@section('title', 'Edit Breed')
@section('page-title', 'Edit Breed')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl border shadow-sm p-6">

        <form action="{{ route('admin.breeds.update', $breed) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-2">Breed Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $breed->name) }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">{{ old('description', $breed->description) }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    <option value="active" {{ old('status', $breed->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $breed->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold hover:bg-green-800">
                    Update Breed
                </button>
                <a href="{{ route('admin.breeds.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection