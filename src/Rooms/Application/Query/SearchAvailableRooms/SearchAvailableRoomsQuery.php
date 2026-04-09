<?php
namespace App\Rooms\Application\Query\SearchAvailableRooms;

use App\Shared\Application\Bus\Query\QueryInterface;

final class SearchAvailableRoomsQuery implements QueryInterface {
    private function __construct() {}

    public static function create(): self {
        return new self();
    }
}
