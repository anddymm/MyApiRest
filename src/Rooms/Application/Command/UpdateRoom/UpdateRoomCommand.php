<?php
namespace App\Rooms\Application\Command\UpdateRoom;

use App\Rooms\Domain\RoomStatus;
use App\Shared\Application\Bus\Command\CommandInterface;

final class UpdateRoomCommand implements CommandInterface {
    private function __construct(
        public readonly int $id,
        public readonly ?RoomStatus $status,
        public readonly bool $updateImageUrl,
        public readonly ?string $imageUrl,
    ) {}

    public static function create(int $id, array $fields): self {
        if (empty($fields)) {
            throw new \InvalidArgumentException('No fields provided for update');
        }

        $knownFields = ['status', 'image_url'];
        $unknownFields = array_diff(array_keys($fields), $knownFields);
        if (!empty($unknownFields)) {
            throw new \InvalidArgumentException(
                'Unknown fields: ' . implode(', ', $unknownFields)
            );
        }

        $status = null;
        if (isset($fields['status'])) {
            $status = RoomStatus::tryFrom($fields['status']);
            if ($status === null) {
                $valid = implode(', ', array_column(RoomStatus::cases(), 'value'));
                throw new \InvalidArgumentException(
                    "Invalid status '{$fields['status']}'. Valid values: {$valid}"
                );
            }
        }

        return new self(
            id:             $id,
            status:         $status,
            updateImageUrl: array_key_exists('image_url', $fields),
            imageUrl:       $fields['image_url'] ?? null,
        );
    }
}
