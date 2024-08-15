<?php

namespace Database\Seeders;

use App\Models\Lung;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first();
        $lungs = ['Investimentos', 'Entrada', 'Despesas Fixas', 'Despesas Eventuais', 'Lazer'];

        foreach ($lungs as $key => $lung) {
            Lung::factory()->create([
                'name' => $lung,
                'user_id' => $user->id
            ]);
        }
    }
}
