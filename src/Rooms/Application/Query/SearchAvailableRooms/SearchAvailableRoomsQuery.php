<?php
namespace App\Rooms\Application\Query\SearchAvailableRooms;

final class SearchAvailableRoomsQuery {
    private function __construct() {}

    public static function create(): self {
        return new self();
    }
}
