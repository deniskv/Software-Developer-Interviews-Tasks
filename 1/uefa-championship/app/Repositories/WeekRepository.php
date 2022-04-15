<?php

namespace App\Repositories;


use App\Models\Week;
use App\Repositories\Interfaces\WeekInterface;

class WeekRepository implements WeekInterface
{
    /**
     * @var Week
     */
    private $week;

    public function __construct(Week $week)
    {
        $this->week = $week;
    }

    public function setPlayed(int $week)
    {
        return $this->week->where('id', $week)->setPlayed();
    }

    public function getUpcomingWeek()
    {
        return $this->week
            ->notPlayed()
            ->orderBy('number')
            ->firstOrFail();
    }

    public function getCurrentWeek()
    {
        return $this->week
            ->played()
            ->orderBy('number', 'desc')
            ->first();
    }

    public function getUpcomingWeeks()
    {
        return $this->week
            ->notPlayed()
            ->orderBy('number')
            ->get();
    }
}
