<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taux extends Model
{
    use HasFactory;
    protected $fillable=[
        'taux_prestation_sociales_court_et_long_terme_salarie',
        'taux_prestation_sociales_court_et_long_terme_patronal',
        'taux_allocation_familiales_salarie',
        'taux_allocation_familiales_patronale',
        'taux_taxe_de_formation_professionnelle_salarie',
        'taux_taxe_de_formation_professionnelle_patronale',
        'taux_amo_salarie',
        'taux_amo_patronale',
        'taux_participation_AMO_salarie',
        'taux_participation_AMO_patronale',
    ];
}
