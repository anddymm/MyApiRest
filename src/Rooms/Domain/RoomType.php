<?php
namespace App\Rooms\Domain;

class RoomType {
    public function __construct(
        private ?int $id,
        private string $name,
        private string $description,
        private float $basePrice,
        private int $capacity
    ) {
        if ($this->basePrice < 0) {
            throw new \InvalidArgumentException("El precio no puede ser negativo");
        }
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'base_price' => $this->basePrice,
            'capacity' => $this->capacity
        ];
    }
}