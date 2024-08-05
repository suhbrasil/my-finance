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
            'name' => 'Entradas',
            'name' => 'Despesas Fixas',
            'name' => 'Despesas Eventuais',
            'name' => 'Lazer',
            'name' => 'Investimentos',
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
