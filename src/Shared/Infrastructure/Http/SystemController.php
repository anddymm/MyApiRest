<?php
namespace App\Shared\Infrastructure\Http;

use Flight;
use App\Shared\Application\GetCurrentDateUseCase;

class SystemController {
    private GetCurrentDateUseCase $useCase;

    public function __construct(GetCurrentDateUseCase $useCase) {
        $this->useCase = $useCase;
    }

    public function __invoke() {

        $systemDate = $this->useCase->execute();

        Flight::json($systemDate->toArray());
    }
}
