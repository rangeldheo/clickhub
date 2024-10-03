<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permite a autorização para todas as requisições
    }

    public function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id', // Verifica se o fornecedor existe
            'category_id' => 'required|exists:categories,id', // Verifica se a categoria existe
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0', // Verifica se o preço é numérico e maior que 0
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif.',
            'image.max' => 'A imagem não pode ser maior que 2MB.',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'O fornecedor é obrigatório.',
            'supplier_id.exists' => 'O fornecedor deve existir.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria deve existir.',
            'name.required' => 'O nome do produto é obrigatório.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'price.min' => 'O preço deve ser maior que zero.',
        ];
    }

    /**
     * Prepara os dados para validação.
     */
    protected function prepareForValidation()
    {
        $user = Auth::user();

        // Insere o ID do usuário logado na request antes da validação
        $this->merge([
            'supplier_id' => $user->supplier->id, // Obtém o ID do usuário logado e insere no 'user_id'
        ]);
    }
}
