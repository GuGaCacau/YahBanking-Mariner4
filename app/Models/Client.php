<?php

// Model dos Clientes

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    // $fillabe para cadastrar informações em massa
    protected $fillabe = [
        'first_name',
        'last_name',
        'email',
        'avatar',
        'invested_amount',
        'uninvested_amount'
    ];

    // Relação Many to Many com Investimentos
    public function investments()
    {
        return $this->belongsToMany('App\Models\Investment');
    }
}
