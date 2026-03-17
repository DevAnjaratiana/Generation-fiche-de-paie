<?php

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
        Schema::create('primes', function (Blueprint $table) {
            $table->id();
            
        $table->foreignId('employee_id')
              ->constrained()
              ->onDelete('cascade');

        $table->string('libelle');
        $table->decimal('montant', 10, 2);
        $table->tinyInteger('mois');
        $table->year('annee');

        $table->timestamps();

        $table->unique(['employee_id', 'mois', 'annee', 'libelle']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primes');
    }
};
