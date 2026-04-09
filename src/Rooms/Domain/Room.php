<?php
namespace App\Rooms\Domain;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rooms')]
class Room {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'room_number', type: 'string', length: 10)]
    private string $roomNumber;

    #[ORM\Column(type: 'string', length: 20, enumType: RoomStatus::class)]
    private RoomStatus $status;

    #[ORM\Column(name: 'image_url', type: 'string', nullable: true)]
    private ?string $imageUrl;

    #[ORM\ManyToOne(targetEntity: RoomType::class)]
    #[ORM\JoinColumn(name: 'room_type_id', referencedColumnName: 'id')]
    private RoomType $roomType;

    public function __construct(
        string $roomNumber,
        RoomStatus $status,
        RoomType $roomType,
        ?string $imageUrl = null,
    ) {
        $this->roomNumber = $roomNumber;
        $this->status     = $status;
        $this->roomType   = $roomType;
        $this->imageUrl   = $imageUrl;
    }

    public function id(): ?int         { return $this->id; }
    public function roomNumber(): string { return $this->roomNumber; }
    public function status(): RoomStatus { return $this->status; }
    public function imageUrl(): ?string  { return $this->imageUrl; }
    public function roomType(): RoomType { return $this->roomType; }

    public function updateStatus(RoomStatus $status): void {
        $this->status = $status;
    }

    public function updateImageUrl(?string $imageUrl): void {
        $this->imageUrl = $imageUrl;
    }

    public function toArray(): array {
        return [
            'id'          => $this->id,
            'room_number' => $this->roomNumber,
            'status'      => $this->status->value,
            'image_url'   => $this->imageUrl,
            'type_name'   => $this->roomType->name(),
            'base_price'  => $this->roomType->basePrice(),
        ];
    }
}
