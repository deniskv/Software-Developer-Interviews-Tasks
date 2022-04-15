<?php

namespace App\Repositories;

use App\Models\Matches;
use App\Repositories\Interfaces\MatchInterface;

class MatchRepository implements MatchInterface
{
    /**
     * @var Matches
     */
    private $match;

    public function __construct(Matches $match)
    {
        $this->match = $match;
    }

    public function allByWeek(int $week, array $with = [])
    {
        return $this->match
            ->when($with, function ($q) use ($with) {
                $q->with($with);
            })
            ->where('week', $week)
            ->get();
    }

    public function create(array $result)
    {
        return $this->match->create($result);
    }
}
