<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permite a autorização para todas as requisições
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', // Verifica se o usuário existe
            'address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2',
        ];
    }


    public function messages()
    {
        return [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'O usuário deve existir na tabela de usuários.',
            'address.string' => 'O endereço deve ser uma string.',
            'address.max' => 'O endereço não pode ter mais de 255 caracteres.',
            // Adicione mensagens personalizadas para outras regras conforme necessário
        ];
    }

    /**
     * Prepara os dados para validação.
     */
    protected function prepareForValidation()
    {
        // Insere o ID do usuário logado na request antes da validação
        $this->merge([
            'user_id' => Auth::id(), // Obtém o ID do usuário logado e insere no 'user_id'
        ]);
    }
}
