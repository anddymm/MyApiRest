<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Infrastructure\Database\DatabaseConnection;
use App\Shared\Infrastructure\SharedFactory;
use App\Shared\Infrastructure\Http\SharedRoutes;
use App\Rooms\Infrastructure\RoomsFactory;

header('Content-Type: application/json');

Flight::register('db', 'PDO', [], function() {
    return DatabaseConnection::getConnection();
});
// Shared routes
$systemController = SharedFactory::createSystemController();
SharedRoutes::register($systemController);

// Rooms routes
$roomController = RoomsFactory::createController();
Flight::route('GET /rooms', $roomController);

Flight::route('GET /', function() {
    Flight::json(['message' =>'Hello World']);
});

Flight::start();
