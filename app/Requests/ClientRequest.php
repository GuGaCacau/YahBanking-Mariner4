<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required','email',
                Rule::unique('clients', 'email')->ignore($this->id)],
            'avatar' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
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
            'avatar.required' => 'Por favor, escolha um avatar.',
            'avatar.image' => 'Por favor, escolha um avatar válido (imagem).',
            'avatar.mimes' => 'Os formatos de imagem permitidos são png, jpg, jpeg, gif e svg.',
        ];
    }
}
