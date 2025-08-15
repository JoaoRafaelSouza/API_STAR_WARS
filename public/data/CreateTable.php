<?php
require_once __DIR__ . '/../autoload.php';

use DAOS\ConexaoDao;

$conn = ConexaoDao::Conexao();

try {
    // Cria tabela filmes
    $sqlFilmes = "CREATE TABLE IF NOT EXISTS filmes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        numero_episodio INT NOT NULL,
        sinopse TEXT NOT NULL,
        data_lancamento DATE NOT NULL,
        diretor VARCHAR(255) NOT NULL,
        produtores TEXT NOT NULL,
        personagens TEXT NOT NULL,
        idade_filme VARCHAR(50) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $conn->exec($sqlFilmes);
    echo "Tabela 'filmes' criada com sucesso!\n";

    // Cria tabela log_api
    $sqlLog = "CREATE TABLE IF NOT EXISTS log_api (
        id INT AUTO_INCREMENT PRIMARY KEY,
        data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        solicitacao VARCHAR(255) NOT NULL,
        rota VARCHAR(255) NOT NULL,
        status VARCHAR(50) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $conn->exec($sqlLog);
    echo "Tabela 'log_api' criada com sucesso!\n";

} catch (PDOException $e) {
    echo "Erro ao criar tabela: " . $e->getMessage();
}