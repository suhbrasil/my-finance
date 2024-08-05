<?php

use App\Models\Lung;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lungs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Lung::create([
            'name' => 'Investimentos',
        ]);
        Lung::create([
            'name' => 'Entradas',
        ]);
        Lung::create([
            'name' => 'Despesas Fixas',
        ]);
        Lung::create([
            'name' => 'Despesas Eventuais',
        ]);
        Lung::create([
            'name' => 'Lazer',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lungs');
    }
};
