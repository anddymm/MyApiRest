<?php
namespace App\Shared\Infrastructure;

use App\Shared\Application\GetCurrentDateUseCase;
use App\Shared\Infrastructure\Http\SystemController;

class SharedFactory {
    
    public static function createSystemController(): SystemController {

        $useCase = new GetCurrentDateUseCase();

        return new SystemController($useCase);
    }
}
