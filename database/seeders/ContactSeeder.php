<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure we have groups
        $groupIds = ContactGroup::pluck('id')->toArray();

        // Check if groups exist
        if (empty($groupIds)) {
            // Call the group seeder first
            $this->call(ContactGroupSeeder::class);
            $groupIds = ContactGroup::pluck('id')->toArray();
        }

        // Create 50 contacts with random groups
        foreach (range(1, 50) as $index) {
            Contact::factory()->create([
                'contact_group_id' => $groupIds[array_rand($groupIds)]
            ]);
        }
    }
}
