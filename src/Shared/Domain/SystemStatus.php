<?php
namespace App\Shared\Domain;

enum SystemStatus: string {
    case OK = 'OK';
    case MAINTENANCE = 'MAINTENANCE';
    case ERROR = 'ERROR';
}
