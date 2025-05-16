<?php

namespace App\Http\Controllers;

use App\Models\ContactGroup;
use Illuminate\Http\Request;

class ContactGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = ContactGroup::withCount('contacts')->get();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_groups',
            'description' => 'nullable|string',
        ]);

        ContactGroup::create($validated);

        return redirect()->route('groups.index')
            ->with('success', 'Grup kontak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function showContacts(ContactGroup $group)
    {
        $contacts = $group->contacts()->paginate(10);
        $groupName = $group->name;

        return view('contacts.index', compact('contacts', 'groupName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactGroup $group)
    {
        return view('groups.edit', compact('group'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactGroup $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_groups,name,' . $group->id,
            'description' => 'nullable|string',
        ]);

        $group->update($validated);

        return redirect()->route('groups.index')
            ->with('success', 'Grup kontak berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactGroup $group)
    {
        // Check if group has contacts
        if ($group->contacts()->count() > 0) {
            return redirect()->route('groups.index')
                ->with('error', 'Grup masih memiliki kontak! Hapus atau pindahkan kontak terlebih dahulu.');
        }

        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Grup kontak berhasil dihapus!');
    }
}
