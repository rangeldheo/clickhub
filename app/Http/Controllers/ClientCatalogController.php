<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth
use App\Services\MercadoLivreService;


class ClientCatalogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->client) {
            return redirect(404);
        }

        // Recupera apenas os produtos do fornecedor associado e os pagina
        $products =  $user->client ? $user->client->products()->with(['category'])->paginate(10) : collect();

        return view('clientsCatalog.index', compact('products'));
    }
}
