<?php
namespace App\Rooms\Application\Query\SearchRooms;

use App\Shared\Application\Bus\Query\QueryInterface;

final class SearchRoomsQuery implements QueryInterface {
    private function __construct() {}

    public static function create(): self {
        return new self();
    }
}
