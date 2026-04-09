<?php
namespace App\Rooms\Application\Query\SearchRooms;

final class SearchRoomsQuery {
    private function __construct() {}

    public static function create(): self {
        return new self();
    }
}
