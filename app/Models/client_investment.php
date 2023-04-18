<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class client_investment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'client_investment';

    // $fillabe para cadastrar informações em massa
    protected $fillabe = [
        'client_id',
        'investment_id',
        'investment_amount',
    ];
}
