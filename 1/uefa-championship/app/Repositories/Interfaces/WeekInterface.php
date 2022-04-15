<?php

namespace App\Repositories\Interfaces;

interface WeekInterface
{
    public function setPlayed(int $week);

    public function getUpcomingWeek();

    public function getCurrentWeek();

    public function getUpcomingWeeks();
}
