<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestRetrieveRequest extends FormRequest
{
    public function rules(): array
    {
        //Validando o tamanho e tipo da imagem do avatar e se existem as outras infos
        return [
            'new_valor' => 'required|numeric|gt:0.00',
        ];
    }

    //Chamada de função de formatação
    public function getValidatorInstance()
    {
        $this->formatValor();

        return parent::getValidatorInstance();
    }

    //Formatando a vírgula pelo ponto no número a fim de validar como numeric 
    protected function formatValor()
    {
        if($this->request->has('new_valor')){
            $this->merge([
                'new_valor' => str_replace(',', '.', $this->request->get('new_valor'))
            ]);
        }
    }

    public function messages()
    {
        //Mensagens de erro para cada caso
        return [
            'new_valor.required' => 'Por favor, complete o campo.',
            'new_valor.numeric' => 'Por favor, escolha um valor numérico.',
            'new_valor.gt' => 'O valor deve ser positivo.',
        ];
    }
}
