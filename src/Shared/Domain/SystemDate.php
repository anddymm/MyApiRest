<?php
namespace App\Shared\Domain;

class SystemDate {
    private string $isoDate;
    private string $timezone;

    public function __construct(string $isoDate, string $timezone) {
        $this->isoDate = $isoDate;
        $this->timezone = $timezone;
    }

    public function toArray(): array {
        return [
            'date' => $this->isoDate,
            'timezone' => $this->timezone,
            'status' => 'active'
        ];
    }
}
