<?php
namespace App\Shared\Infrastructure\Http;

use Flight;

class SharedRoutes {

    public static function register(SystemController $controller) {
        
        Flight::group('/system', function() use ($controller) {
            Flight::route('GET /time', [$controller, '__invoke']);
            Flight::route('GET /status', function() {
                Flight::json(['status' => 'OK']);
            });
        });
        
    }
}
