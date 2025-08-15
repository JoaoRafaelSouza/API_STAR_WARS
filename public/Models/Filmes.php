<?php
namespace Models;

class Filmes
{
    public $id;
    public $nome;
    public $numero_episodio;
    public $sinopse;
    public $data_lancamento;
    public $diretor;
    public $produtores;
    public $personagens; // pode ser string (JSON) ou array
    public $idade_filme;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->nome = $data['nome'] ?? '';
        $this->numero_episodio = $data['numero_episodio'] ?? 0;
        $this->sinopse = $data['sinopse'] ?? '';
        $this->data_lancamento = $data['data_lancamento'] ?? '';
        $this->diretor = $data['diretor'] ?? '';
        $this->produtores = $data['produtores'] ?? '';

        // Se vier JSON, converte para array
        if (isset($data['personagens']) && is_string($data['personagens'])) {
            $this->personagens = json_decode($data['personagens'], true) ?? [];
        } else {
            $this->personagens = $data['personagens'] ?? [];
        }

        // Calcula idade do filme
        if (!empty($data['data_lancamento'])) {
            $this->idade_filme = $this->calcularIdade($data['data_lancamento']);
        } else {
            $this->idade_filme = '';
        }
    }

    private function CalcularIdade($release_date)
    {
        $release = new \DateTime($release_date);
        $today = new \DateTime();
        $diff = $release->diff($today);

        return sprintf('%d anos, %d meses e %d dias', $diff->y, $diff->m, $diff->d);
    }
}