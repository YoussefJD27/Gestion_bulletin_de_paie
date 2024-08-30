<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    use HasFactory;

    protected $fillable=[
        'description',
        'montant',
        'type',
        'salarie_id',
    ];

    public function salaries()
    {
        return $this->belongsTo(Salarie::class,'salarie_id');
    } 
}
