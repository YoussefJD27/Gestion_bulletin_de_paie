<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarie extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom',
        'prenom',
        'ville',
        'cin',
        'date_embauche',
        'tel',
        'salaire_de_base',
    ];


    public function primes()
    {
        return $this->hasMany(Prime::class);
    } 
    public function salaire()
    {
        return $this->hasMany(Salaire::class);
    } 
}
