<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;
use App\Rooms\Application\SearchRoomsUseCase;

class RoomController {
    public function __construct(private SearchRoomsUseCase $useCase) {}

    public function __invoke() {
        $rooms = $this->useCase->execute();
        Flight::json($rooms);
    }
}
