<?php
require_once __DIR__ . '/autoload.php';

// Carrega variáveis de ambiente
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

// Roteamento simples
$rota = $_GET['rota'] ?? '';

switch ($rota) {
    case 'filmes':
        require_once __DIR__ . '/Controllers/Filme_Controller.php';
        $controller = new Filme_Controller();
        $controller->listarFilmes();
        break;

    default:
        echo json_encode(['erro' => 'Rota inválida']);
}