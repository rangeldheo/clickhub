<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id', // Verifica se o usuário existe
            'company_name' => 'required|string|max:255',
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
            'company_name.required' => 'O nome da empresa é obrigatório.',
            'company_name.string' => 'O nome da empresa deve ser uma string.',
            'company_name.max' => 'O nome da empresa não pode ter mais de 255 caracteres.',
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
