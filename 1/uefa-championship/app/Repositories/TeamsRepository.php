<?php


namespace App\Repositories;


use App\Models\Teams;
use App\Repositories\Interfaces\TeamsInterface;

class TeamsRepository implements TeamsInterface
{
    /**
     * @var Teams
     */
    private $team;

    public function __construct(Teams $team)
    {
        $this->team = $team;
    }

    public function find(int $team_id)
    {
        return $this->team->find($team_id);
    }

    public function getTeamsIds()
    {
        return $this->team
            ->select('id')
            ->get()
            ->pluck('id')
            ->toArray();
    }
}
