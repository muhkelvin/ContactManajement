<?php

namespace Database\Factories;

use App\Models\ContactGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactGroup>
 */
class ContactGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groups = ['Pelanggan', 'Vendor', 'Keluarga', 'Teman', 'Kolega', 'Lainnya'];

        return [
            'name' => $this->faker->randomElement($groups),
            'description' => $this->faker->sentence(),
        ];
    }
}
