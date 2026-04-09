<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;
use App\Rooms\Application\Query\SearchRooms\SearchRoomsQuery;
use App\Rooms\Application\Query\SearchAvailableRooms\SearchAvailableRoomsQuery;
use App\Rooms\Application\Command\UpdateRoom\UpdateRoomCommand;
use App\Rooms\Domain\Exception\RoomNotFoundException;
use App\Rooms\Domain\Exception\InvalidRoomStatusTransitionException;
use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Application\Bus\Query\QueryBus;

class RoomController {
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly CommandBus $commandBus,
    ) {}

    // GET /rooms
    public function list(): void {
        $rooms = $this->queryBus->ask(SearchRoomsQuery::create());
        Flight::json($rooms);
    }

    // GET /rooms/available
    public function listAvailable(): void {
        $rooms = $this->queryBus->ask(SearchAvailableRoomsQuery::create());
        Flight::json($rooms);
    }

    // GET /rooms/view
    public function view(): void {
        $rooms = $this->queryBus->ask(SearchRoomsQuery::create());
        $this->renderView($rooms, 'Todas las habitaciones');
    }

    // GET /rooms/available/view
    public function viewAvailable(): void {
        $rooms = $this->queryBus->ask(SearchAvailableRoomsQuery::create());
        $this->renderView($rooms, 'Habitaciones disponibles');
    }

    // PATCH /rooms/@id
    public function update(int $id): void {
        $data = Flight::request()->data->getData();

        try {
            $command = UpdateRoomCommand::create($id, $data);
            $this->commandBus->dispatch($command);
        } catch (\InvalidArgumentException $e) {
            Flight::halt(400, json_encode(['error' => $e->getMessage()]));
        } catch (InvalidRoomStatusTransitionException $e) {
            Flight::halt(422, json_encode(['error' => $e->getMessage()]));
        } catch (RoomNotFoundException $e) {
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
