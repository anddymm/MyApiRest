<?php
namespace App\Rooms\Application\Command\UpdateRoom;

use App\Rooms\Domain\RoomRepository;
use App\Rooms\Domain\Exception\RoomNotFoundException;
use App\Shared\Application\Bus\Command\CommandHandlerInterface;

final class UpdateRoomCommandHandler implements CommandHandlerInterface {
    public function __construct(private readonly RoomRepository $repository) {}

    public function __invoke(UpdateRoomCommand $command): void {
        $room = $this->repository->findById($command->id);

        if ($room === null) {
            throw new RoomNotFoundException($command->id);
        }

        if ($command->status !== null) {
            $room->changeStatus($command->status);
        }

        if ($command->updateImageUrl) {
            $room->updateImageUrl($command->imageUrl);
        }

        $this->repository->save($room);
    }
}
