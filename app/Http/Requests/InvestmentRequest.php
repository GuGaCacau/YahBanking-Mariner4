<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentRequest extends FormRequest
{
    public function rules(): array
    {
        //Validando o tamanho e tipo da imagem do avatar e se existem as outras infos
        return [
            'commercial_name' => 'required',
            'commercial_sail' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        //Mensagens de erro para cada caso
        return [
            'commercial_name.required' => 'Por favor, complete o campo de "Nome Comercial".',
            'commercial_sail.required' => 'Por favor, complete o campo de "Sigla Comercial".',
            'description.required' => 'Por favor, complete o campo de "Descrição".',
        ];
    }
}
