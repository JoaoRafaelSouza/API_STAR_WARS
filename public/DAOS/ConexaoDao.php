<?php
namespace DAOS;

use PDO;
use PDOException;

class ConexaoDao
{
    private static $conn;

    public static function Conexao()
    {
        if (!self::$conn) {
            $host = getenv('DB_HOST') ?: 'db';
            $dbname = getenv('MYSQL_DATABASE') ?: 'api';
            $user = getenv('MYSQL_USER') ?: 'admin';
            $pass = getenv('MYSQL_PASSWORD') ?: '123';
            $port = getenv('DB_PORT') ?: '3306';

            try {
                self::$conn = new PDO(
                    "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException("Erro de conexão: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}