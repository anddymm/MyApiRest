<?php
namespace App\Rooms\Domain;

interface RoomRepository {
    public function findAll(): array;
    public function update(int $id, array $data): bool;
}
