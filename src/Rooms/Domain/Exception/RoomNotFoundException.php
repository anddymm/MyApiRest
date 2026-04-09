<?php
namespace App\Rooms\Domain\Exception;

final class RoomNotFoundException extends \DomainException {
    public function __construct(int $id) {
        parent::__construct("Room not found: {$id}");
    }
}
