<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'year' => $this->faker->year,
            'total_year' => $this->faker->numberBetween(100, 150),
            'attendance_type' => rand(0, 1),
            'student_id' => $this->faker->numberBetween(0, 10),
            'classs_id' => $this->faker->numberBetween(0, 10),
            'present' => $this->faker->numberBetween(0, 100),
            'absent' => $this->faker->numberBetween(0, 20),
            'sick' => $this->faker->numberBetween(0, 10),
            'leave' => $this->faker->numberBetween(0, 5),
        ];
    }
}
