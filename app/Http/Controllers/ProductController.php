<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\MercadoLivreService;
use Illuminate\Support\Facades\Auth; // Importa a classe Autht
use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Obtém o usuário logado
        $supplier = $user->supplier; // Obtém o fornecedor associado ao usuário

        // Recupera apenas os produtos do fornecedor associado e os pagina
        $products = $supplier ? $supplier->products()->with(['category'])->paginate(10) : collect();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Obtém os fornecedores e categorias disponíveis
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('products.create', compact('suppliers', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public'); // Armazena a imagem na pasta public/images/products
        }
        // Cria um novo produto com a imagem
        Product::create(array_merge($request->validated(), ['image' => $imagePath]));
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Verifique se o produto pertence ao fornecedor do usuário logado
        if ($product->supplier_id !== Auth::user()->supplier->id) {
            return redirect()->route('products.index')->with('error', 'Você não tem permissão para editar este produto.');
        }

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Verifique se o produto pertence ao fornecedor do usuário logado
        if ($product->supplier_id !== Auth::user()->supplier->id) {
            return redirect()->route('products.index')->with('error', 'Você não tem permissão para editar este produto.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function publishProduct(Product $product)
    {
        $mercadoLivreService = new MercadoLivreService();
        $accessToken = $mercadoLivreService->getAccessToken();
        $client = new Client();

        try {

            $response = $client->post('https://api.mercadolibre.com/items', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    "title" => $product->name,
                    "category_id" => "MLB1714",
                    "price" =>  $product->price,
                    "currency_id" => "BRL",
                    "available_quantity" => 2,
                    "listing_type_id" => 'gold_pro', // Tipo de listagem
                    "condition" => "new",
                    "description" => "Mouse gamer com iluminação RGB e DPI ajustável. Ideal para jogos.",
                    "pictures" => [
                        [
                            "source" => "https://resource.logitech.com/content/dam/logitech/en/products/mice/m171/gallery/m171-mouse-top-view-grey.png"
                        ]
                    ],
                    "attributes" => [
                        [
                            "id" => "BRAND",
                            "name" => "Marca",
                            "value_name" => "Logitech" // Adicione value_id se disponível
                        ],
                        [
                            "id" => "MODEL",
                            "name" => "modelo",
                            "value_name" => "Logitech XTD 16" // Adicione value_id se disponível
                        ],
                        [
                            "id" => "TYPE",
                            "name" => "Tipo",
                            "value_name" => "Com fio" // Adicione value_id se disponível
                        ],
                        [
                            "id" => "GTIN",
                            "name" => "GTIN",
                            "value_name" => " 07898555212039" // Insira o valor correto do GTIN
                        ]
                    ],
                    "shipping" => [
                        "mode" => "custom",
                        "local_pick_up" => false,
                        "free_shipping" => false
                    ]
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            // Atualiza o produto com os dados do Mercado Livre
            $product->meli_id = $result['id']; // Salva o ID da publicação
            $product->meli_json = json_encode($result); // Salva o JSON decodificado

            $product->save(); // Salva as alterações no banco de dados

            return redirect()->route('client-catalog.index')->with('success', 'Produto atualizado com sucesso!');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Aqui capturamos o erro da requisição
            $errorResponse = $e->getResponse();
            $statusCode = $errorResponse->getStatusCode();
            $responseBody = $errorResponse->getBody()->getContents();

            return redirect()->route('client-catalog.index')->with('error', 'Não foi possível publicar o produto.');

            // // Exibe o status e o corpo da resposta de erro
            // dd([
            //     'status_code' => $statusCode,
            //     'error' => json_decode($responseBody, true)
            // ]);
        } catch (\Exception $e) {
            // Captura outros tipos de exceções
            // dd(['error' => $e->getMessage()]);
            return redirect()->route('client-catalog.index')->with('error', 'Erro inesperado');
        }
    }

    public function deleteProduct($itemId)
    {
        // Instanciar o cliente Guzzle
        $client = new Client();

        $mercadoLivreService = new MercadoLivreService();
        $accessToken = $mercadoLivreService->getAccessToken();

        try {
            // Enviar a requisição DELETE para a API do Mercado Livre
            $response = $client->delete("https://api.mercadolivre.com/items/{$itemId}?access_token={$accessToken}", [
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

            // Retornar a resposta da API
            return response()->json([
                'message' => 'Produto excluído com sucesso.',
                'response' => json_decode($response->getBody())
            ], 200);
        } catch (\Exception $e) {
            // Tratar erros
            return response()->json([
                'error' => 'Erro ao excluir o produto',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function chooseProduct(Product $product)
    {
        // Obtém o cliente logado
        $client = Auth::user()->client;

        // Verifica se o cliente está logado
        if ($client) {
            // Adiciona o produto ao cliente logado, sem duplicar
            $client->products()->syncWithoutDetaching($product->id);

            return redirect()->back()->with('success', 'Produto escolhido com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao escolher o produto.');
    }
}
