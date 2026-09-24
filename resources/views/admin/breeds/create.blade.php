@extends('admin.layouts.app')

@section('title', 'Add Breed')
@section('page-title', 'Add Breed')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl border shadow-sm p-6">

        <form action="{{ route('admin.breeds.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block font-semibold mb-2">Breed Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold hover:bg-green-800">
                    Save Breed
                </button>
                <a href="{{ route('admin.breeds.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection