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
        Schema::create('pay_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->tinyInteger('mois');
            $table->year('annee');
            $table->decimal('salaire_base', 15, 2);
            $table->decimal('total_primes', 15, 2);
            $table->decimal('total_retenues', 15, 2);
            $table->decimal('salaire_brut', 15, 2);
            $table->decimal('salaire_net', 15, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_slips');
    }
};
