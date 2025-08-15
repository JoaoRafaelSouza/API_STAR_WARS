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

    public function get($endpoint)
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Erro ao conectar: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, true);
    }
}