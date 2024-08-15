<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Lung;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first();

        $categoriesInv = ['Reserva de Emergência', 'Riqueza', 'Casa Nova', 'Carro Novo', 'Viagens'];
        $categoriesEnt = ['Salário', 'Pensão', 'Bônus/Outras Rendas', 'Freenlancer', 'Vales e Benefícios', 'Aluguéis'];
        $categoriesFix = ['Aluguel', 'Condomínio', 'Água', 'Luz', 'Internet', 'IPTU', 'Diarista/Mensalista', 'Lavanderia', 'Combustível', 'Uber', 'Prestação do carro', 'Seguro do Carro', 'Estacionamento fixo', 'Plano de Saúde', 'Medicamentos contínuo', 'Plano Dentário', 'Escola/Faculdade', 'Outros Cursos', 'Supermercado', 'Suplementos', 'Cabeleireiro', 'Esteticista', 'Academia', 'Seguro de Vida', 'Assinaturas', 'Despesas Diversas'];
        $categoriesEve = ['Médico', 'Dentista', 'Hospital/Remédios', 'Manutenção do Carro', 'Manutenção da Casa', 'Matrículas', 'Cursos/Materiais', 'Uniforme', 'Outros', 'Roupas', 'Calçados', 'Acessórios', 'Produtos cuidado pessoal', 'Presentes', 'Estacionamento', 'IPVA/Outros Tributos', 'Reserva p/ Troca Carro', 'Outros eventuais'];
        $categoriesLaz = ['Viagens', 'Cinema/Teatro', 'Restaurantes/Bares', 'iFood/UberEats/Outros', 'Outros Lazeres'];

        foreach ($categoriesInv as $key => $catInv) {
            Category::factory()->create([
                'name' => $catInv,
                'user_id' => $user->id,
                'lung_id' => Lung::where('name', 'Investimentos')->first()->id,
            ]);
        }

        foreach ($categoriesEnt as $key => $catEnt) {
            Category::factory()->create([
                'name' => $catEnt,
                'user_id' => $user->id,
                'lung_id' => Lung::where('name', 'Entrada')->first()->id,
            ]);
        }

        foreach ($categoriesFix as $key => $catFix) {
            Category::factory()->create([
                'name' => $catFix,
                'user_id' => $user->id,
                'lung_id' => Lung::where('name', 'Despesas Fixas')->first()->id,
            ]);
        }

        foreach ($categoriesEve as $key => $catEve) {
            Category::factory()->create([
                'name' => $catEve,
                'user_id' => $user->id,
                'lung_id' => Lung::where('name', 'Despesas Eventuais')->first()->id,
            ]);
        }

        foreach ($categoriesLaz as $key => $catLaz) {
            Category::factory()->create([
                'name' => $catLaz,
                'user_id' => $user->id,
                'lung_id' => Lung::where('name', 'Lazer')->first()->id,
            ]);
        }
    }
}
