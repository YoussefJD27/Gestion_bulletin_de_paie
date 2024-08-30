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
        Schema::create('tauxes', function (Blueprint $table) {
            $table->id();
            $table->float('taux_prestation_sociales_court_et_long_terme_salarie')->default(0);
            $table->float('taux_prestation_sociales_court_et_long_terme_patronal')->default(0);
            $table->float('taux_allocation_familiales_salarie')->default(0);
            $table->float('taux_allocation_familiales_patronale')->default(0);
            $table->float('taux_taxe_de_formation_professionnelle_salarie')->default(0);
            $table->float('taux_taxe_de_formation_professionnelle_patronale')->default(0);
            $table->float('taux_amo_salarie')->default(0);
            $table->float('taux_amo_patronale')->default(0);
            $table->float('taux_participation_AMO_salarie')->default(0);
            $table->float('taux_participation_AMO_patronale')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
};
