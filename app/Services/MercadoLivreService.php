<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class MercadoLivreService
{
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $refresh_token;

    public function __construct()
    {
        $this->client_id = env('MERCADO_LIVRE_CLIENT_ID');
        $this->client_secret = env('MERCADO_LIVRE_CLIENT_SECRET');
        $this->redirect_uri = env('MERCADO_LIVRE_REDIRECT_URI');
        $this->refresh_token = env('MERCADO_LIVRE_REFRESH_TOKEN');
    }

    public function refreshToken()
    {
        $client = new Client();

        try {
            // Fazendo a requisição HTTP para renovar o token
            $response = $client->post('https://api.mercadolibre.com/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'refresh_token' => $this->refresh_token,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]);

            // Decodificando a resposta JSON
            $data = json_decode($response->getBody()->getContents(), true);

            // Armazena o novo access_token e refresh_token
            $this->storeTokens($data['access_token'], $data['refresh_token']);

            return $data;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao renovar token', 'message' => $e->getMessage()], 500);
        }
    }

    // Função para armazenar os tokens em cache ou banco de dados
    public function storeTokens($access_token, $refresh_token)
    {
        // Aqui você pode armazenar os tokens em um banco de dados, cache, etc.
        // Exemplo: Armazenando em cache por 5 horas e 50 minutos (próximo da expiração)
        Cache::put('mercadolivre_access_token', $access_token, now()->addMinutes(350));
        Cache::put('mercadolivre_refresh_token', $refresh_token);
    }

    // Função para obter o access_token armazenado
    public function getAccessToken()
    {
        if (!Cache::has('mercadolivre_access_token')) {
            // Se o token expirou, renovamos com o refresh_token
            $refresh_token = Cache::get('mercadolivre_refresh_token');
            $this->refreshToken($refresh_token);
        }

        return Cache::get('mercadolivre_access_token');
    }
}
