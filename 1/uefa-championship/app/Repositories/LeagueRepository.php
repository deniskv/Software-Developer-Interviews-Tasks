<?php

namespace App\Repositories;

use App\Models\League;
use App\Repositories\Interfaces\LeagueInterface;

class LeagueRepository implements LeagueInterface
{
    /**
     * @var League
     */
    private $league;

    public function __construct(League $league)
    {
        $this->league = $league;
    }

    public function all(array $with = [])
    {
        return $this->league
            ->when($with, function ($q) use ($with) {
                $q->with($with);
            })
            ->orderBy('points', 'desc')
            ->orderBy('goal_diff', 'desc')
            ->get();
    }

    public function getTeam(int $team_id)
    {
        return $this->league->where('team_id', $team_id)->first();
    }
}
