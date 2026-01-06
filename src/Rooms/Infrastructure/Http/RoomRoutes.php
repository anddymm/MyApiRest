<?php
namespace App\Rooms\Infrastructure\Http;

use Flight;

class RoomRoutes {
    public static function register(RoomController $controller) {
        Flight::group('/rooms', function() use ($controller) {
            Flight::route('GET /', [$controller, 'list']);
            
            Flight::route('PATCH /@id:[0-9]+', [$controller, 'update']);
        });
    }
}
