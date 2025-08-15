<?php
namespace DAOS;
class ConexaoDao
{
    private static $conn;

    public static function getConnection()
    {
        if (!self::$conn) {
            $host = 'db'; // nome do serviço no docker-compose
            $dbname = getenv('MYSQL_DATABASE') ?: 'api';
            $user = getenv('MYSQL_USER') ?: 'admin';
            $pass = getenv('MYSQL_PASSWORD') ?: '123';
            $port = getenv('DB_PORT') ?: '3306';

            try {
                self::$conn = new PDO(
                    "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8",
                    $user,
                    $pass,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}