<?php
namespace App\Rooms\Application\Query\SearchRooms;

use App\Rooms\Domain\RoomRepository;
use App\Shared\Application\Bus\Query\QueryHandlerInterface;

final class SearchRoomsQueryHandler implements QueryHandlerInterface {
    public function __construct(private readonly RoomRepository $repository) {}

    public function __invoke(SearchRoomsQuery $query): array {
        return array_map(
            fn($room) => $room->toArray(),
            $this->repository->findAll()
        );
    }
}
