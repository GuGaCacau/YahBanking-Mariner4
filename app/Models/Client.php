<?php

// Model dos Clientes

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // $fillabe para cadastrar informações em massa
    protected $fillabe = [
        'first-name',
        'last-name',
        'email',
        'avatar',
    ];

    // Relação Many to Many com Investimentos
    public function investments(){
        return $this->belongsToMany('App\Models\Investment');
    }
}
