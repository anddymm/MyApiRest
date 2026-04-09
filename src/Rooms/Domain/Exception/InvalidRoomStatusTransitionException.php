<?php
namespace App\Rooms\Domain\Exception;

use App\Rooms\Domain\RoomStatus;

final class InvalidRoomStatusTransitionException extends \DomainException {
    public function __construct(int $roomId, RoomStatus $from, RoomStatus $to) {
        parent::__construct(
            "Invalid status transition for room {$roomId}: '{$from->value}' → '{$to->value}'"
        );
    }
}
