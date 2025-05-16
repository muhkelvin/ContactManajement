@extends('layouts.app')

@section('title', 'Contact Groups')
@section('subtitle', 'Manage your contact groups')

@section('content')
    <div class="overflow-x-auto rounded-lg border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-600 uppercase">Group Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-600 uppercase hidden md:table-cell">Description</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-600 uppercase">Contacts</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-600 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            @foreach($groups as $group)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i data-feather="folder" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $group->name }}</div>
                                <div class="text-sm text-gray-500 md:hidden">{{ Str::limit($group->description, 30) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                        <div class="text-sm text-gray-900">{{ $group->description ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                {{ $group->contacts_count }} Contacts
              </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-3">
                        <a href="{{ route('groups.contacts', $group) }}" class="text-emerald-600 hover:text-emerald-900 p-2 rounded-lg hover:bg-emerald-50" title="View Contacts">
                            <i data-feather="users" class="w-5 h-5"></i>
                        </a>
                        <a href="{{ route('groups.edit', $group) }}" class="text-indigo-600 hover:text-indigo-900 p-2 rounded-lg hover:bg-indigo-50" title="Edit">
                            <i data-feather="edit" class="w-5 h-5"></i>
                        </a>
                        <button onclick="openGroupDeleteModal({{ $group->id }})" class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 focus:outline-none" title="Delete">
                            <i data-feather="trash-2" class="w-5 h-5"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('groups.create') }}" class="px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:shadow-lg transition-all flex items-center space-x-2">
            <i data-feather="plus" class="w-5 h-5"></i>
            <span>New Group</span>
        </a>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="group-delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this group?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeGroupDeleteModal()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">Cancel</button>
                <form id="group-delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();

        function openGroupDeleteModal(id) {
            const modal = document.getElementById('group-delete-modal');
            const form = document.getElementById('group-delete-form');
            form.action = `/groups/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeGroupDeleteModal() {
            const modal = document.getElementById('group-delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('group-delete-modal').addEventListener('click', function(e) {
            if (e.target.id === 'group-delete-modal') {
                closeGroupDeleteModal();
            }
        });
    </script>
@endsection
