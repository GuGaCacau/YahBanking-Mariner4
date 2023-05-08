<?php

// Model dos Investimentos

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory;
    use SoftDeletes;

    // $fillabe para cadastrar informações em massa
    protected $fillable = [
        'commercial_name',
        'commercial_sail',
        'description',
    ];

    // Relação Many to Many com Clientes
    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
