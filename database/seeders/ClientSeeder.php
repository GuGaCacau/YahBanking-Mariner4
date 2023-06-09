<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\Client;

//Facade para fazer consumir por Http
use Illuminate\Support\Facades\Http;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Incluindo constantes da aplicação (valor_total)
        include(app_path('includes/constants.php'));
        $constants = getConstants();

        $clients = Http::get('https://reqres.in/api/users?page=1')->collect();

        //Consumo de informações dos clientes de forma automática para o banco de dados
        foreach ($clients["data"] as $client) {
            Client::create([
                'first_name' => $client["first_name"],
                'last_name' => $client["last_name"],
                'email' => $client["email"],
                'avatar' => $client["avatar"],
                'invested_amount' => 0,
                'uninvested_amount' => $constants["valor_total"]
            ]);
        }
    }
}
