<?php

namespace Database\Seeders;

use App\Models\ContactGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'Pelanggan', 'description' => 'Semua kontak pelanggan'],
            ['name' => 'Vendor', 'description' => 'Kontak pemasok dan vendor'],
            ['name' => 'Keluarga', 'description' => 'Anggota keluarga'],
            ['name' => 'Teman', 'description' => 'Teman dan kenalan'],
            ['name' => 'Kolega', 'description' => 'Rekan kerja dan kolega bisnis'],
        ];

        foreach ($groups as $group) {
            ContactGroup::create($group);
        }
    }
}
