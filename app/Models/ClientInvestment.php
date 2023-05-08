<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInvestment extends Model
{
    use HasFactory;

    protected $table = 'client_investment';

    // $fillabe para cadastrar informações em massa
    protected $fillable = [
        'client_id',
        'investment_id',
        'investment_amount',
    ];
}
