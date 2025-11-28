<?php
namespace ProjetTransfo\Classes;

use PDO;
use PDOStatement;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $config = Config::getDatabaseConfig();
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";

        $this->pdo = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public function prepare(string $query): PDOStatement
    {
        return $this->pdo->prepare($query);
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
