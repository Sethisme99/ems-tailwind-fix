<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'id_staff' => DB::table('staff')->inRandomOrder()->value('id'),
                'employee_id' => Employee::inRandomOrder()->value('id'),
                'date' => $date = fake()->date(),
                'check_in' => $checkIn = fake()->time('H:i:s'),
                'check_out' => $checkOut = Carbon::parse($checkIn)->addHours(fake()->numberBetween(1, 8))->format('H:i:s'),
        ];
    }
}
