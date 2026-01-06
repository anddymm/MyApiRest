<?php
namespace App\Rooms\Infrastructure;

use App\Rooms\Infrastructure\Persistence\PdoRoomRepository;
use App\Rooms\Application\SearchRoomsUseCase;
use App\Rooms\Application\UpdateRoomUseCase;
use App\Rooms\Infrastructure\Http\RoomController;
use Flight;

class RoomsFactory {
    public static function createController(): RoomController {
        $db = Flight::get('db');
        $repository = new PdoRoomRepository($db);
        
        $searchUseCase = new SearchRoomsUseCase($repository);
        $updateUseCase = new UpdateRoomUseCase($repository);
        
        return new RoomController($searchUseCase, $updateUseCase);
    }
}
