<?php
namespace App\Rooms\Application;

use App\Rooms\Domain\RoomRepository;

class UpdateRoomUseCase {
    public function __construct(private RoomRepository $repository) {}

    public function execute(int $id, array $data): bool {
        
        return $this->repository->update($id, $data);
    }
}
