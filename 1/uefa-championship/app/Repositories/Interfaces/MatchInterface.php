<?php

namespace App\Repositories\Interfaces;

interface MatchInterface
{
    public function allByWeek(int $week, array $with = []);

    public function create(array $result);
}
