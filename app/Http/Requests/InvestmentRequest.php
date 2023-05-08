<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class InvestmentRequest extends FormRequest
{
    public function rules(): array
    {
        //Validando o tamanho e tipo da imagem do avatar e se existem as outras infos
        return [
            'commercial_name' => ['required',
                Rule::unique('investments', 'commercial_name')->ignore($this->id)],
            'commercial_sail' => ['required',
                Rule::unique('investments', 'commercial_sail')->ignore($this->id)],
            'description' => 'required',
        ];
    }

    public function messages()
    {
        //Mensagens de erro para cada caso
        return [
            'commercial_name.required' => 'Por favor, complete o campo de "Nome Comercial".',
            'commercial_name.unique' => 'O nome comercial escolhido já está cadastrado.',
            'commercial_sail.required' => 'Por favor, complete o campo de "Sigla Comercial".',
            'commercial_sail.unique' => 'A sigla comercial escolhida já está cadastrado.',
            'description.required' => 'Por favor, complete o campo de "Descrição".',
        ];
    }
}
