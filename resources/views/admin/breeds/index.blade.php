@extends('admin.layouts.app')

@section('title', 'Breeds')
@section('page-title', 'Breeds')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <p class="text-gray-500">Manage goat breeds in your system.</p>
        </div>

        <a href="{{ route('admin.breeds.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-green-700 text-white font-bold hover:bg-green-800">
            <i class="fa-solid fa-plus"></i> Add Breed
        </a>

    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <div class="p-4 border-b">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search breeds..." class="border rounded-lg px-4 py-2 flex-1">
                <button type="submit" class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Name</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Description</th>
                        <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Goats</th>
                        <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($breeds as $breed)
                        <tr>
                            <td class="px-6 py-4 font-semibold">{{ $breed->name }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ Str::limit($breed->description, 60) }}</td>
                            <td class="px-6 py-4 text-center">{{ $breed->goats_count }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $breed->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($breed->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.breeds.edit', $breed) }}" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fa-solid fa-edit"></i></a>
                                <form action="{{ route('admin.breeds.destroy', $breed) }}" method="POST" class="inline" onsubmit="return confirm('Delete this breed?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">No breeds found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="p-4 border-t">
            {{ $breeds->links() }}
        </div>

    </div>

</div>

@endsection