<?php

namespace App\Services;

class PlanningDay
{
    public int $number;

    public string $description;

    public bool $isInMonth;

    public $date;

    public $demands = [];

    public function __construct(int $number, int $dayOfWeek, bool $isInMonth = true, $dt)
    {
        $this->number = $number;

        $this->isInMonth = $isInMonth;

        $this->description = DateService::getDayDescription($dayOfWeek);

        $this->date = $dt->format('Y-m-d');
    }

}
