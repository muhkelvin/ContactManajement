@extends('layouts.app')

@section('title', 'Edit Group')
@section('subtitle', 'Update group information')

@section('content')
    <form action="{{ route('groups.update', $group) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-6 max-w-2xl">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Group Name *</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-200 focus:border-purple-500 @error('name') border-red-500 @enderror"
                       value="{{ old('name', $group->name) }}">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-200 focus:border-purple-500">{{ old('description', $group->description) }}</textarea>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('groups.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:shadow-lg transition-all">
                    Update Group
                </button>
            </div>
        </div>
    </form>
@endsection
