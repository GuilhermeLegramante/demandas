<?php

namespace App\Services;

use Carbon\Carbon;

class PlanningMonth
{
    public Carbon $now;

    public int $daysInMonth;

    public int $dayOfWeek;

    public string $description;

    public int $dayNumber;

    public int $year;

    public int $month;

    public $days = [];

    public $weeks = [];

    private $demands;

    public function __construct($year, $month, $day, $demands)
    {
        $this->now = Carbon::createFromDate($year, $month, $day);

        $this->daysInMonth = $this->now->daysInMonth;

        $this->dayOfWeek = $this->now->dayOfWeek;

        $this->description = DateService::getMonthDescription($this->now->format('m'));

        $this->dayNumber = $this->now->format('d');

        $this->year = $this->now->format('Y');

        $this->month = $this->now->format('m');

        $this->setDays();

        $this->weeks = array_chunk($this->days, 7);

        $this->demands = $demands;

        $this->setDemandsAtDays();
    }

    /**
     * Configure previous month values
     * The Calendar has 42 spaces on front-end, thus, we have that configure empty spaces
     */
    private function setDays()
    {
        $date = new Carbon('last day of last month');
        $lastDayOfLastMonth = $date->format('d');
        $lastDayWeekOfLastMonth = $date->dayOfWeek + 0;

        $previousNumbers = [];
        $previousDaysWeek = [];

        $dayNumber = $lastDayOfLastMonth + 0;

        // Set values from last month in a temp array
        for ($i = $lastDayWeekOfLastMonth; $i >= 1; $i--) {
            array_push($previousNumbers, $dayNumber);
            array_push($previousDaysWeek, $lastDayWeekOfLastMonth);

            $dayNumber = $dayNumber - 1;
            $lastDayWeekOfLastMonth = $lastDayWeekOfLastMonth - 1;
        }

        // Sort to make "31, 30, 29..." like "29, 30, 31"
        sort($previousNumbers);
        sort($previousDaysWeek);

        // Set day object
        foreach ($previousNumbers as $dayNumber) {
            if ($this->month == 1) {
                $month = 12;
            } else {
                $month = $this->month - 1;
            }

            $dt = Carbon::createFromDate($this->year, $month, $dayNumber);

            $number = new PlanningDay($dayNumber, $dt->dayOfWeek, false, $dt);

            array_push($this->days, $number);
        }

        // Set current month days
        for ($i = 1; $i <= $this->daysInMonth; $i++) {
            $dt = Carbon::createFromDate($this->year, $this->month, $i);

            $number = new PlanningDay($i, $date->dayOfWeek, true, $dt);

            array_push($this->days, $number);
        }

        // Set days from next month
        $date = new Carbon('last day of this month');

        $lastDayWeekOfThisMonth = $date->dayOfWeek;

        $totalNextDays = 7 - $lastDayWeekOfThisMonth;

        $dayWeekOfNextMonth = $lastDayWeekOfThisMonth + 1;

        for ($i = 1; $i <= $totalNextDays; $i++) {
            if ($this->month == 12) {
                $month = 1;
            } else {
                $month = $this->month + 1;
            }

            $dt = Carbon::createFromDate($this->year, $month, $i);

            $number = new PlanningDay($i, $dayWeekOfNextMonth, false, $dt);

            array_push($this->days, $number);

            $dayWeekOfNextMonth++;
        }

    }

    /**
     * Set Collection of demands at days
     */
    private function setDemandsAtDays()
    {
        foreach ($this->days as $day) {
            $demands = [];

            foreach ($this->demands as $demand) {
                $date = date('Y-m-d', strtotime($demand->publicationDate));

                if ($day->date == $date) {
                    array_push($demands, $demand);
                }
                $day->demands = $demands;
            }
        }
    }
}
