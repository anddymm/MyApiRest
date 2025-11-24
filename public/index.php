<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Infrastructure\Database\DatabaseConnection;
use App\Shared\Infrastructure\SharedFactory;
use App\Shared\Infrastructure\Http\SharedRoutes;

header('Content-Type: application/json');

$pdo = DatabaseConnection::getConnection();

$systemController = SharedFactory::createSystemController();

SharedRoutes::register($systemController);

Flight::route('GET /', function() {
    Flight::json(['message' => 'API Hexagonal']);
});

Flight::start();
