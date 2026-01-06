<?php
namespace App\Rooms\Infrastructure;

use App\Rooms\Infrastructure\Persistence\PdoRoomRepository;
use App\Rooms\Application\SearchRoomsUseCase;
use App\Rooms\Infrastructure\Http\RoomController;
use Flight;

class RoomsFactory {
    public static function createController(): RoomController {
        // Obtenemos la conexión ya establecida con Flight::get
        $db = Flight::get('db');

        $repository = new PdoRoomRepository($db);
        $useCase = new SearchRoomsUseCase($repository);
        return new RoomController($useCase);
    }
}
