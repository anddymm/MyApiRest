<?php
namespace App\Rooms\Application;

use App\Rooms\Domain\RoomRepository;

class SearchRoomsUseCase {
    public function __construct(private RoomRepository $repository) {}

    public function execute(): array {
        return $this->repository->findAll();
    }
}
