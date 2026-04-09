<?php
namespace App\Rooms\Infrastructure\Persistence;

use App\Rooms\Domain\Room;
use App\Rooms\Domain\RoomRepository;
use App\Rooms\Domain\RoomStatus;
use Doctrine\ORM\EntityManager;

class DoctrineRoomRepository implements RoomRepository {
    public function __construct(private readonly EntityManager $em) {}

    public function findAll(): array {
        return $this->em->getRepository(Room::class)->findAll();
    }

    public function findAvailable(): array {
        return $this->em->getRepository(Room::class)->findBy([
            'status' => RoomStatus::AVAILABLE,
        ]);
    }

    public function findById(int $id): ?Room {
        return $this->em->find(Room::class, $id);
    }

    public function save(Room $room): void {
        $this->em->persist($room);
        $this->em->flush();
    }
}
