<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;
use App\Rooms\Application\SearchRoomsUseCase;
use App\Rooms\Application\SearchAvailableRoomsUseCase;
use App\Rooms\Application\UpdateRoomUseCase;

class RoomController {
    public function __construct(
        private SearchRoomsUseCase $searchUseCase,
        private SearchAvailableRoomsUseCase $searchAvailableUseCase,
        private UpdateRoomUseCase $updateUseCase
    ) {}

    // GET /rooms
    public function list() {
        $rooms = $this->searchUseCase->execute();
        Flight::json($rooms);
    }

    // GET /rooms/available
    public function listAvailable() {
        $rooms = $this->searchAvailableUseCase->execute();
        Flight::json($rooms);
    }

    // GET /rooms/view
    public function view() {
        $rooms = $this->searchUseCase->execute();
        $this->renderView($rooms, 'Todas las habitaciones');
    }

    // GET /rooms/available/view
    public function viewAvailable() {
        $rooms = $this->searchAvailableUseCase->execute();
        $this->renderView($rooms, 'Habitaciones disponibles');
    }

    private function renderView(array $rooms, string $pageTitle): void {
        header('Content-Type: text/html');
        $template = file_get_contents(__DIR__ . '/views/rooms.html');
        echo str_replace(
            ['{{ROOMS_JSON}}', '{{PAGE_TITLE}}', '{{CURRENT_DATE}}'],
            [json_encode($rooms), $pageTitle, date('d M Y')],
            $template
        );
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
