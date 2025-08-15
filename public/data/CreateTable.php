<?php
require_once __DIR__ . '/ConexaoDAO.php';

$conn = ConexaoDAO::getConnection();

$sql = "
CREATE TABLE IF NOT EXISTS filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    numero_episodio INT NOT NULL,
    sinopse TEXT NOT NULL,
    data_lancamento DATE NOT NULL,
    diretor VARCHAR(255) NOT NULL,
    produtores TEXT NOT NULL,
    personagens TEXT NOT NULL,
    idade_filme VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

try {
    $conn->exec($sql);
    echo "Tabela 'filmes' criada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar tabela: " . $e->getMessage();
}