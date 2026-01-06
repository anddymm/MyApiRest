<?php
namespace App\Rooms\Domain;

interface RoomRepository {
    public function findAll(): array;
}
