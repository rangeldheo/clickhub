<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class SupplierController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->supplier) {
            return redirect(404);
        }

        // Obtém o fornecedor associado ao usuário
        $supplier = $user->supplier;
        $totalProducts = $supplier->totalProducts();

        return view('suppliers.index', compact('totalProducts')); // Retorna a view com a lista de fornecedores
    }

    public function create()
    {
        return view('suppliers.create'); // Retorna a view para criar um novo fornecedor
    }

    public function store(SupplierRequest $request)
    {
        // Validação já realizada no SupplierRequest
        Supplier::create($request->validated()); // Cria um novo fornecedor
        return redirect()->route('suppliers.index')->with('success', 'Fornecedor criado com sucesso!');
    }

    // public function show(Supplier $supplier)
    // {
    //     return view('suppliers.show', compact('supplier')); // Retorna a view com os detalhes do fornecedor
    // }

    // public function edit(Supplier $supplier)
    // {
    //     return view('suppliers.edit', compact('supplier')); // Retorna a view para editar o fornecedor
    // }

    // public function update(SupplierRequest $request, Supplier $supplier)
    // {
    //     // Validação já realizada no SupplierRequest
    //     $supplier->update($request->validated()); // Atualiza o fornecedor existente
    //     return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
    // }

    // public function destroy(Supplier $supplier)
    // {
    //     $supplier->delete(); // Deleta o fornecedor
    //     return redirect()->route('suppliers.index')->with('success', 'Fornecedor deletado com sucesso!');
    // }
}
