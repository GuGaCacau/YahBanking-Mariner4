<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPatchRequest extends FormRequest
{
    
    public function rules(): array
    {
        //Validando o tamanho e tipo da imagem do avatar e se existem as outras infos
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        //Mensagens de erro para cada caso
        return [
            'first_name.required' => 'Por favor, complete o campo de "Nome".',
            'last_name.required' => 'Por favor, complete o campo de "Sobrenome".',
            'email.required' => 'Por favor, complete o campo de "Email".',
            'email.email' => 'Por favor, escolha um email válido.',
        ];
    }
}
