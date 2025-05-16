<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportContacts()
    {
        $contacts = Contact::with('group')->get();

        return $this->generateCsv($contacts, 'all-contacts.csv');
    }

    /**
     * Export contacts from a specific group to CSV.
     */
    public function exportGroupContacts(ContactGroup $group)
    {
        $contacts = $group->contacts()->get();
        $filename = 'contacts-' . strtolower(str_replace(' ', '-', $group->name)) . '.csv';

        return $this->generateCsv($contacts, $filename);
    }

    /**
     * Generate CSV file from contacts collection.
     */
    private function generateCsv($contacts, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');

            // Add CSV header
            fputcsv($file, ['Nama', 'Email', 'Telepon', 'Alamat', 'Catatan', 'Grup']);

            // Add data rows
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->address,
                    $contact->notes,
                    $contact->group ? $contact->group->name : '-',
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
