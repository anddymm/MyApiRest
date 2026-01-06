<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;
use App\Rooms\Application\SearchRoomsUseCase;
use App\Rooms\Application\UpdateRoomUseCase;

class RoomController {
    // Inyectamos ambos casos de uso
    public function __construct(
        private SearchRoomsUseCase $searchUseCase,
        private UpdateRoomUseCase $updateUseCase
    ) {}

    // GET /rooms
    public function list() {
        $rooms = $this->searchUseCase->execute();
        Flight::json($rooms);
    }

    // PATCH /rooms/@id
    public function update(int $id) {
        $data = Flight::request()->data->getData();
        
        if (empty($data)) {
            Flight::halt(400, json_encode(['error' => 'No data provided']));
        }

        $success = $this->updateUseCase->execute($id, $data);

        if (!$success) {
            Flight::halt(404, json_encode(['error' => 'Room not found or no changes made']));
        }

        Flight::json(['message' => 'Room updated successfully']);
    }
}
