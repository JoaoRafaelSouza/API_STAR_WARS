<?php
namespace DAOS;

use Exception;

class BaseApiDao
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = getenv('API_BASE_URL') ?: 'https://www.swapi.tech/api';
    }

    public function Pegar($endpoint)
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout 10s
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Erro ao conectar: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        if ($httpCode >= 400) {
            throw new Exception('Erro na API: ' . ($data['detail'] ?? $response));
        }

        return $data;
    }
}