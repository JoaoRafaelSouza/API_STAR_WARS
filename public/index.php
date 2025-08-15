<?php
require_once __DIR__ . '/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

require __DIR__ . '/Views/template/header.php';

$rota = $_GET['rota'] ?? '';
$id = $_GET['id'] ?? null;

$controller = new Controllers\Filme_Controller();

switch ($rota) {
    case 'filmes':
        $controller->ListarFilmes();
        break;

    case 'detalhes':
        if ($id)
            $controller->DetalhesFilme($id);
        else
            header('Location: index.php');
        break;

    default:
        $controller->ListarFilmes();
        break;
}

require __DIR__ . '/Views/template/footer.php';