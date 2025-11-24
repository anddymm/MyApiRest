<?php

namespace App\Shared\Infrastructure\Database;

use PDO;
use PDOException;
use Flight;

class DatabaseConnection
{

    public static function getConnection(): PDO
    {
        $dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        try {
            return new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            Flight::halt(500, json_encode([
                'error' => 'Error crítico de conexión a base de datos',
                'details' => $e->getMessage()
            ]));
            exit;
        }
    }
}
