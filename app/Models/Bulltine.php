<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulltine extends Model
{
    use HasFactory;
    
    protected $fillable=[
        
        'salaire_brut',
        'total_deduction',
        'salaire_net',
        'ir',
        'salarie_id',
    ];


    public function salarie()
    {
        return $this->belongsTo(Salarie::class ,'salarie_id');
    }

}
