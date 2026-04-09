<?php
namespace App\Rooms\Application\Query\SearchAvailableRooms;

use App\Rooms\Domain\RoomRepository;
use App\Shared\Application\Bus\Query\QueryHandlerInterface;

final class SearchAvailableRoomsQueryHandler implements QueryHandlerInterface {
    public function __construct(private readonly RoomRepository $repository) {}

    public function __invoke(SearchAvailableRoomsQuery $query): array {
        return array_map(
            fn($room) => $room->toArray(),
            $this->repository->findAvailable()
        );
    }
}
