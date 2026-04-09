<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use App\Shared\Infrastructure\SharedFactory;
use App\Shared\Infrastructure\Http\SharedRoutes;
use App\Rooms\Infrastructure\RoomsFactory;
use App\Rooms\Infrastructure\Http\RoomRoutes;

header('Content-Type: application/json');

$em = DoctrineEntityManagerFactory::create();

// --- Shared ---
$systemController = SharedFactory::createSystemController();
SharedRoutes::register($systemController);

// --- Rooms ---
RoomRoutes::register(RoomsFactory::createController($em));

Flight::route('/', function () {
    echo json_encode(['message' => 'Hello, World!']);
});

Flight::start();
