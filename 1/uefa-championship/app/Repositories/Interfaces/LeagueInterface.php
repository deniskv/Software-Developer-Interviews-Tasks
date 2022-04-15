<?php


namespace App\Repositories\Interfaces;


interface LeagueInterface
{
    public function all(array $with = []);

    public function getTeam(int $team_id);
}
