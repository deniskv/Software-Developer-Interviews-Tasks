<?php


namespace App\Repositories\Interfaces;


interface TeamsInterface
{
    public function find(int $team_id);

    public function getTeamsIds();
}
