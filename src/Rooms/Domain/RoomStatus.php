<?php
namespace App\Rooms\Domain;

enum RoomStatus: string {
    case AVAILABLE = 'available';
    case MAINTENANCE = 'maintenance';
    case OCCUPIED = 'occupied';
}
