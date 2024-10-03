<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class ClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->client) {
            return redirect(404);
        }

        // Verifica se o cliente existe e conta os produtos associados
        $totalProducts = $user->client ? $user->client->products()->count() : 0;

        return view('clients.index', compact('totalProducts')); // Retorna a view com a lista de clientes
    }

    public function create()
    {
        return view('clients.create'); // Retorna a view para criar um novo cliente
    }

    public function store(ClientRequest $request)
    {
        // Validação já realizada no ClientRequest
        Client::create($request->validated()); // Cria um novo cliente
        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso!');
    }

    //     public function show(Client $client)
    //     {
    //         return view('clients.show', compact('client')); // Retorna a view com os detalhes do cliente
    //     }

    //     public function edit(Client $client)
    //     {
    //         return view('clients.edit', compact('client')); // Retorna a view para editar o cliente
    //     }

    //     public function update(ClientRequest $request, Client $client)
    //     {
    //         // Validação já realizada no ClientRequest
    //         $client->update($request->validated()); // Atualiza o cliente existente
    //         return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    //     }

    //     public function destroy(Client $client)
    //     {
    //         $client->delete(); // Deleta o cliente
    //         return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso!');
    //     }
    //
}
