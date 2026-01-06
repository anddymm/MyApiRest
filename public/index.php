<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Infrastructure\Database\DatabaseConnection;
use App\Shared\Infrastructure\SharedFactory;
use App\Shared\Infrastructure\Http\SharedRoutes;
use App\Rooms\Infrastructure\RoomsFactory;
use App\Rooms\Infrastructure\Http\RoomRoutes; // Importamos el nuevo archivo

header('Content-Type: application/json');

// Usamos set para compartir la instancia de PDO
Flight::set('db', DatabaseConnection::getConnection());

// --- Shared ---
$systemController = SharedFactory::createSystemController();
SharedRoutes::register($systemController);
// --- Rooms ---
RoomRoutes::register(RoomsFactory::createController());

//-- hello world test ---
Flight::route('/', function(){
    echo json_encode(['message' => 'Hello, World!']);
});

Flight::start();
