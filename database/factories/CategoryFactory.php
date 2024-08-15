<?php

namespace Database\Factories;

use App\Models\Lung;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        return [
            'name' => fake()->jobTitle(),
            'user_id' => $user->id,
            'lung_id' => Lung::inRandomOrder()->first()->id,
        ];
    }
}
