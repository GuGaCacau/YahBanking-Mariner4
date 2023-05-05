<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    
    public function rules(): array
    {
        //Validando o tamanho e tipo da imagem do avatar e se existem as outras infos
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
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
            'avatar.required' => 'Por favor, escolha um avatar.',
            'avatar.image' => 'Por favor, escolha um avatar válido (imagem).',
            'avatar.mimes' => 'Os formatos de imagem permitidos são png, jpg, jpeg, gif e svg.',
        ];
    }
}
