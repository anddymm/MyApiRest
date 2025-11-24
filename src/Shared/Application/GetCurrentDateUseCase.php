<?php
namespace App\Shared\Application;

use App\Shared\Domain\SystemDate;

class GetCurrentDateUseCase {
    
    public function execute(): SystemDate {

        return new SystemDate(
            date('Y-m-d H:i:s'),
            date_default_timezone_get()
        );
    }
}
