<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'first_name_en' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'last_name_en' => $this->faker->lastName,
            'father_name' => $this->faker->name('male'),
            'father_name_en' => $this->faker->name('male'),
            'grand_father' => $this->faker->name('male'),
            'image' => $this->faker->imageUrl(),
            'dob' => $this->faker->date,
            'classs_id' => $this->faker->numberBetween(1, 10), // Adjust the range based on your class IDs
            'base_number' => $this->faker->unique()->numerify('#######'),
            'tazkira_number' => $this->faker->unique()->numerify('####-####-####'),
            // 'current_residence' => $this->faker->numberBetween(1, 10),
            'main_residence' => $this->faker->numberBetween(1, 10),
        ];
    }
}
