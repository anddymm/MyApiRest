<?php
namespace App\Rooms\Application\Command\UpdateRoom;

use App\Rooms\Domain\RoomStatus;

final class UpdateRoomCommand {
    private function __construct(
        public readonly int $id,
        public readonly ?RoomStatus $status,
        public readonly bool $updateImageUrl,
        public readonly ?string $imageUrl,
    ) {}

    public static function create(int $id, array $fields): self {
        return new self(
            id:            $id,
            status:        isset($fields['status']) ? RoomStatus::from($fields['status']) : null,
            updateImageUrl: array_key_exists('image_url', $fields),
            imageUrl:      $fields['image_url'] ?? null,
        );
    }
}
