<?php
require_once __DIR__ . '/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

$rota = $_GET['rota'] ?? '';

switch ($rota) {
    case 'filmes':
        $controller = new Controllers\Filme_Controller();
        $controller->listarFilmes();
        break;

    default:
        require __DIR__ . '/Views/Principal.php';
}