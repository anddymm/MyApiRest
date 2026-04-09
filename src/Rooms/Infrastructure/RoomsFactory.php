<?php
namespace App\Rooms\Infrastructure;

use App\Rooms\Infrastructure\Persistence\DoctrineRoomRepository;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQueryHandler;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQueryHandler;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommandHandler;
use App\Rooms\Infrastructure\Http\RoomController;
use Doctrine\ORM\EntityManager;

class RoomsFactory {
    public static function createController(EntityManager $em): RoomController {
        $repository = new DoctrineRoomRepository($em);

        return new RoomController(
            searchRoomsHandler:          new SearchRoomsQueryHandler($repository),
            searchAvailableRoomsHandler: new SearchAvailableRoomsQueryHandler($repository),
            updateRoomHandler:           new UpdateRoomCommandHandler($repository),
        );
    }
}
