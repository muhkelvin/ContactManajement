@extends('layouts.app')

@section('title', 'Contact List')
@section('subtitle', 'Manage your contacts efficiently')

@section('content')
    <div class="overflow-x-auto rounded-lg border border-gray-100">
        <table class="min-w-max w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-3 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-sm font-semibold text-indigo-600 uppercase">Name</th>
                <th class="px-3 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-sm font-semibold text-indigo-600 uppercase">Contact Info</th>
                <th class="px-3 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-sm font-semibold text-indigo-600 uppercase hidden lg:table-cell">Address</th>
                <th class="px-3 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-sm font-semibold text-indigo-600 uppercase">Group</th>
                <th class="px-3 sm:px-6 py-2 sm:py-4 text-left text-xs sm:text-sm font-semibold text-indigo-600 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            @foreach($contacts as $contact)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-indigo-600 font-medium">{{ substr($contact->name, 0, 2) }}</span>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <div class="text-sm sm:text-base font-medium text-gray-900">{{ $contact->name }}</div>
                                <div class="text-xs sm:text-sm text-gray-500">{{ $contact->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                        <div class="text-xs sm:text-sm text-gray-900">{{ $contact->phone }}</div>
                        <div class="text-xs sm:text-sm text-gray-500">{{ $contact->email }}</div>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap hidden lg:table-cell">
                        <div class="text-xs sm:text-sm text-gray-900">{{ $contact->address }}</div>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
              <span class="px-2 sm:px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs sm:text-sm">
                {{ $contact->group->name ?? 'No Group' }}
              </span>
                    </td>
                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap space-x-2">
                        <a href="{{ route('contacts.show', $contact) }}" class="text-emerald-600 hover:text-emerald-900 p-2 rounded-lg hover:bg-emerald-50" title="View Details">
                            <i data-feather="eye" class="w-5 h-5"></i>
                        </a>
                        <a href="{{ route('contacts.edit', $contact) }}" class="text-indigo-600 hover:text-indigo-900 p-2 rounded-lg hover:bg-indigo-50" title="Edit">
                            <i data-feather="edit" class="w-5 h-5"></i>
                        </a>
                        <button onclick="openDeleteModal({{ $contact->id }})" class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 focus:outline-none" title="Delete">
                            <i data-feather="trash-2" class="w-5 h-5"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 sm:mt-6">
        {{ $contacts->links() }}
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this contact?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">Cancel</button>
                <form id="delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();

        function openDeleteModal(id) {
            const modal = document.getElementById('delete-modal');
            const form = document.getElementById('delete-form');
            form.action = `/contacts/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal on outside click
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target.id === 'delete-modal') {
                closeDeleteModal();
            }
        });
    </script>
@endsection
