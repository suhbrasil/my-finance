<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first();
        $accounts = ['Cartão de Crédito', 'Cartão de Débito', 'Vale Benefícios', 'Dinheiro'];

        foreach ($accounts as $key => $account) {
            Account::factory()->create([
                'name' => $account,
                'user_id' => $user->id
            ]);
        }
    }
}
