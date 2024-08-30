<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable=[
        'nbr_joure_t',
        'montant_heures_supplementaires',
        'anciennete',
        'salarie_id',
    ];

    
    public function salarie()
    {
        return $this->belongsTo(Salarie::class,'salarie_id');
    } 
}
