<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQuery;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQueryHandler;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQuery;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQueryHandler;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommand;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommandHandler;

class RoomController {
    public function __construct(
        private readonly SearchRoomsQueryHandler $searchRoomsHandler,
        private readonly SearchAvailableRoomsQueryHandler $searchAvailableRoomsHandler,
        private readonly UpdateRoomCommandHandler $updateRoomHandler,
    ) {}

    // GET /rooms
    public function list(): void {
        $rooms = ($this->searchRoomsHandler)(SearchRoomsQuery::create());
        Flight::json($rooms);
    }

    // GET /rooms/available
    public function listAvailable(): void {
        $rooms = ($this->searchAvailableRoomsHandler)(SearchAvailableRoomsQuery::create());
        Flight::json($rooms);
    }

    // GET /rooms/view
    public function view(): void {
        $rooms = ($this->searchRoomsHandler)(SearchRoomsQuery::create());
        $this->renderView($rooms, 'Todas las habitaciones');
    }

    // GET /rooms/available/view
    public function viewAvailable(): void {
        $rooms = ($this->searchAvailableRoomsHandler)(SearchAvailableRoomsQuery::create());
        $this->renderView($rooms, 'Habitaciones disponibles');
    }

    // PATCH /rooms/@id
    public function update(int $id): void {
        $data = Flight::request()->data->getData();

        if (empty($data)) {
            Flight::halt(400, json_encode(['error' => 'No data provided']));
        }

        try {
            ($this->updateRoomHandler)(UpdateRoomCommand::create($id, $data));
        } catch (\ValueError $e) {
            Flight::halt(400, json_encode(['error' => 'Invalid field value: ' . $e->getMessage()]));
        } catch (\RuntimeException $e) {
            Flight::halt(404, json_encode(['error' => $e->getMessage()]));
        }

        Flight::json(['message' => 'Room updated successfully']);
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
}
