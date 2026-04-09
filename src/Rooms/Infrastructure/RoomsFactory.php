<?php
namespace App\Rooms\Infrastructure;

use App\Rooms\Infrastructure\Persistence\DoctrineRoomRepository;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQuery;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQueryHandler;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQuery;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQueryHandler;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommand;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommandHandler;
use App\Rooms\Infrastructure\Http\RoomController;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;
use Doctrine\ORM\EntityManager;

class RoomsFactory {
    public static function createController(EntityManager $em): RoomController {
        $repository = new DoctrineRoomRepository($em);

        $queryBus = new QueryBus();
        $queryBus->register(SearchRoomsQuery::class, new SearchRoomsQueryHandler($repository));
        $queryBus->register(SearchAvailableRoomsQuery::class, new SearchAvailableRoomsQueryHandler($repository));

        $commandBus = new CommandBus();
        $commandBus->register(UpdateRoomCommand::class, new UpdateRoomCommandHandler($repository));

        return new RoomController($queryBus, $commandBus);
    }
}
