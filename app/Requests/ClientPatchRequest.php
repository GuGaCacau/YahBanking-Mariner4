<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class ClientPatchRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required','email',
                Rule::unique('clients', 'email')->ignore($this->id)],
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
            'email.unique' => 'O email escolhido já está cadastrado.',
        ];
    }
}
