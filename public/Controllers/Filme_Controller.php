<?php
namespace Controllers;
use DAOS\BaseApiDao;
use Models\Filmes;
use DAOS\Helpers;
use DAOS\ConexaoDao;

class Filme_Controller
{
    private $dao;
    private $helpers;
    private $conexao;

    public function __construct()
    {
        $this->dao = new BaseApiDao();
        $this->helpers = new Helpers();
        $this->conexao = (new ConexaoDAO())->Conexao();
    }

    public function ListarFilmes()
    {
        try {
            $data = $this->dao->Pegar('/films/');
            $filmes = [];
            foreach ($data['results'] as $f) {
                $props = $f;

                $idFilme = null;
                if (!empty($props['url'])) {
                    $partes = explode('/', trim($props['url'], '/'));
                    $idFilme = end($partes); // último número da URL
                }

                $filmes[] = new Filmes([
                    'id' => $idFilme,
                    'nome' => $props['title'] ?? '',
                    'numero_episodio' => $props['episode_id'] ?? 0,
                    'sinopse' => $props['opening_crawl'] ?? '',
                    'data_lancamento' => $props['release_date'] ?? '',
                    'diretor' => $props['director'] ?? '',
                    'produtores' => $props['producer'] ?? '',
                    'personagens' => $props['characters'] ?? [],
                    'naves' => $props['starships'] ?? [],
                    'veiculos' => $props['vehicles'] ?? [],
                    'planetas' => $props['planets'] ?? [],
                    'especies' => $props['species'] ?? [],
                    'url' => $props['url'] ?? ''
                ]);
            }

            $this->helpers->SalvarLog('listar_filmes', '/filmes', 'sucesso');
            require __DIR__ . '/../Views/Catalogo.php';
        } catch (\Exception $e) {
            $this->helpers->SalvarLog('listar_filmes', '/filmes', 'erro: ' . $e->getMessage());
            echo "Erro ao listar filmes: " . $e->getMessage();
        }
    }

    public function DetalhesFilme($id)
    {
        try {
            $data = $this->dao->Pegar("/films/{$id}/");

            $filme = new Filmes([
                'id' => $id,
                'nome' => $data['title'] ?? '',
                'numero_episodio' => $data['episode_id'] ?? 0,
                'sinopse' => $data['opening_crawl'] ?? '',
                'data_lancamento' => $data['release_date'] ?? '',
                'diretor' => $data['director'] ?? '',
                'produtores' => $data['producer'] ?? '',
                'personagens' => $data['characters'] ?? [],
                'naves' => $data['starships'] ?? [],
                'veiculos' => $data['vehicles'] ?? [],
                'planetas' => $data['planets'] ?? [],
                'especies' => $data['species'] ?? [],
                'url' => $data['url'] ?? ''
            ]);

            $idadeFilme = $this->helpers->CalcularIdadeFilme($filme->data_lancamento);

            $campos = "id, nome, numero_episodio, sinopse, data_lancamento, diretor, produtores, personagens";
            $dados = ":id, :nome, :numero_episodio, :sinopse, :data_lancamento, :diretor, :produtores, :personagens";

            if (!($this->helpers->ExisteFilme($idadeFilme, 'filmes'))) {
                $this->helpers->Inserir($campos, $dados, 'filmes');

                $stmtData = [
                    ':id' => $filme->id,
                    ':nome' => $filme->nome,
                    ':numero_episodio' => $filme->numero_episodio,
                    ':sinopse' => $filme->sinopse,
                    ':data_lancamento' => $filme->data_lancamento,
                    ':diretor' => $filme->diretor,
                    ':produtores' => $filme->produtores,
                    ':personagens' => json_encode($filme->personagens),
                    ':idade_filme' => $idadeFilme
                ];
                $stmt = $this->conexao->prepare("
            INSERT INTO filmes
            (id, nome, numero_episodio, sinopse, data_lancamento, diretor, produtores, personagens, idade_filme) VALUES (:id, :nome, :numero_episodio, :sinopse, :data_lancamento, :diretor, :produtores, :personagens, :idade_filme)
            ON DUPLICATE KEY UPDATE
                nome = VALUES(nome),
                numero_episodio = VALUES(numero_episodio),
                sinopse = VALUES(sinopse),
                data_lancamento = VALUES(data_lancamento),
                diretor = VALUES(diretor),
                produtores = VALUES(produtores),
                personagens = VALUES(personagens)
        ");
                $stmt->execute([
                    ':id' => $filme->id,
                    ':nome' => $filme->nome,
                    ':numero_episodio' => $filme->numero_episodio,
                    ':sinopse' => $filme->sinopse,
                    ':data_lancamento' => $filme->data_lancamento,
                    ':diretor' => $filme->diretor,
                    ':produtores' => $filme->produtores,
                    ':personagens' => json_encode($filme->personagens),
                    ':idade_filme' => $idadeFilme
                ]);
            }

            $this->helpers->SalvarLog('detalhes_filme', "/filmes/{$id}", 'sucesso');

            require __DIR__ . '/../Views/Detalhes.php';
        } catch (\Exception $e) {
            $this->helpers->SalvarLog('detalhes_filme', "/filmes/{$id}", 'erro: ' . $e->getMessage());
            echo "Erro ao exibir detalhes do filme: " . $e->getMessage();
        }
    }
}