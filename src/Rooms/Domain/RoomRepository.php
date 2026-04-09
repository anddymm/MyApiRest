<?php
namespace App\Rooms\Domain;

interface RoomRepository {
    /** @return Room[] */
    public function findAll(): array;

    /** @return Room[] */
    public function findAvailable(): array;

    public function findById(int $id): ?Room;

    public function save(Room $room): void;
}
