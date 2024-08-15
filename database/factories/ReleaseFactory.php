<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\Lung;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Release>
 */
class ReleaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category->id,
            'description' => fake()->text(20),
            'lung_id' => $category->lung_id,
            'account_id' => Account::inRandomOrder()->first()->id,
            'value' => fake()->numberBetween(1, 10000),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'deposit' => ($category->lung_id == 2 || $category->lung_id == 1) ? true : false,
            'user_id' => $user->id,
        ];
    }
}
