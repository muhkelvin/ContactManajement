<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::with('group')->latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }


    public function create()
    {
        $groups = ContactGroup::all();
        return view('contacts.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
           'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'contact_group_id' => 'required|integer|exists:contact_groups,id',
        ]);

        Contact::created($validate);

        return redirect()->route('contacts.index')->with('succes','Kontak Berhasil DiBuat');
    }




    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }


    public function edit(Contact $contact)
    {
        $groups = ContactGroup::all();
        return view('contacts.edit', compact('contact', 'groups'));
    }


    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'contact_group_id' => 'nullable|exists:contact_groups,id',
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'Kontak berhasil diperbarui!');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Kontak berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::with('group')
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->paginate(10);

        return view('contacts.index', compact('contacts', 'search'));
    }
}
