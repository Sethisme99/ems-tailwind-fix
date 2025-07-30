<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\Position;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    return [
        'id_staff'       => $this->faker->unique()->numberBetween(100, 99999), // ✅ use numberBetween
        'first_name'     => $this->faker->firstName,
        'last_name'      => $this->faker->lastName,
        'national_id'    => $this->faker->unique()->numerify('##########'),     // ✅ 10-digit unique ID
        'nssf_id'        => $this->faker->unique()->numerify('########'),       // ✅ 8-digit unique ID
        'phone'          => $this->faker->phoneNumber,
        'place_of_birth' => $this->faker->city,                                 // ✅ more realistic
        'address'        => $this->faker->address,
        'date_of_birth'  => $this->faker->date('Y-m-d', now()->subYears(18)),   // ✅ ensures age ≥ 18
        'hire_date'      => $this->faker->date('Y-m-d'),
        'image'          => 'default.jpg',
        'salary'         => $this->faker->numberBetween(200, 1000),
        'department_id'  => \App\Models\Department::inRandomOrder()->value('id'),
        'position_id'    => \App\Models\Position::inRandomOrder()->value('id'),
        'documents_submitted' => $this->faker->boolean,
        'status'              => $this->faker->boolean,
    ];
}
}