<?php
namespace Controllers;
use DAOS\BaseApiDao;
use Models\Filmes;


class Filme_Controller
{
    public function listarFilmes()
    {
        header('Content-Type: application/json');
        $dao = new BaseApiDao();
        $data = $dao->get('/people/');
        // print_r($data);

        $filmes = [];
        foreach ($data['results'] as $f) {
            print_r($f);
            $filmes[] = new Filmes($f);
        }

        // Retorna como JSON para ser consumido via API
        echo json_encode($filmes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}