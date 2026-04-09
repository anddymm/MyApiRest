<?php
namespace App\Rooms\Domain;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'room_types')]
class RoomType {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(name: 'base_price', type: 'decimal', precision: 10, scale: 2)]
    private float $basePrice;

    #[ORM\Column(type: 'integer')]
    private int $capacity;

    public function __construct(
        string $name,
        ?string $description,
        float $basePrice,
        int $capacity,
    ) {
        if ($basePrice < 0) {
            throw new \InvalidArgumentException("El precio no puede ser negativo");
        }
        $this->name        = $name;
        $this->description = $description;
        $this->basePrice   = $basePrice;
        $this->capacity    = $capacity;
    }

    public function id(): ?int          { return $this->id; }
    public function name(): string      { return $this->name; }
    public function description(): ?string { return $this->description; }
    public function basePrice(): float  { return $this->basePrice; }
    public function capacity(): int     { return $this->capacity; }

    public function toArray(): array {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'base_price'  => $this->basePrice,
            'capacity'    => $this->capacity,
        ];
    }
}
