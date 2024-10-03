<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtém os dados do usuário logado
        $user = Auth::user();
        // Verifica se o usuário tem um registro em suppliers ou clients
        if ($user->supplier) {
            return view('suppliers.profile', ['user' => $user]);
        } elseif ($user->client) {
            // Redireciona para a view dos clientes
            return view('clients.profile', ['user' => $user]);
        }
        // Se o usuário não tiver nenhum dos dois, você pode redirecionar para uma página padrão ou mostrar um erro
        return view('home');
    }
}
