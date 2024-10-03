<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth; // Importa a classe Auth

class CatalogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->client) {
            return redirect(404);
        }

        // Recupera apenas os produtos do fornecedor associado e os pagina
        $products = Product::with('category')->paginate(10);

        return view('catalogs.index', compact('products'));
    }
}
