@extends('layouts.app')

@section('title', $contact->name)
@section('subtitle', 'Contact Details')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0 h-14 w-14 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-indigo-600 font-medium text-xl">{{ substr($contact->name, 0, 2) }}</span>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $contact->name }}</h2>
                        <p class="text-gray-500">{{ $contact->email }}</p>
                    </div>
                </div>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-gray-900">{{ $contact->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-gray-900">{{ $contact->address ?? '-' }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Notes</dt>
                        <dd class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $contact->notes ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Group Information</h3>
                @if($contact->group)
                    <div class="flex items-center">
                        <i data-feather="folder" class="w-5 h-5 text-purple-600 mr-2"></i>
                        <span class="text-gray-900">{{ $contact->group->name }}</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">{{ $contact->group->description }}</p>
                @else
                    <div class="text-gray-500">No group assigned</div>
                @endif
            </div>

            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Activity</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Created At</dt>
                        <dd class="text-sm text-gray-900">{{ $contact->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Last Updated</dt>
                        <dd class="text-sm text-gray-900">{{ $contact->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('contacts.edit', $contact) }}"
                   class="flex-1 text-center px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors">
                    Edit
                </a>
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
