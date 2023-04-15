<?php

// Model dos Investimentos

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    // $fillabe para cadastrar informações em massa
    protected $fillabe = [
        'commercial_name',
        'commercial_sail',
        'description',
    ];

    // Relação Many to Many com Clientes
    public function clients(){
        return $this->belongsToMany('App\Models\Client');
    }
}
