<?php
require_once __DIR__ . '/../DAOS/BaseApiDao.php';
require_once __DIR__ . '/../Models/Filmes.php';

class Filme_Controller
{
    public function listarFilmes()
    {
        $dao = new BaseApiDao();
        $data = $dao->get('/films/');

        $filmes = [];
        foreach ($data['results'] as $f) {
            $filmes[] = new Filmes($f);
        }

        // Retorna como JSON para ser consumido via API
        header('Content-Type: application/json');
        echo json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}