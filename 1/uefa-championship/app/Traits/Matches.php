<?php

namespace App\Traits;

trait Matches
{
    public function playMatches($week, $matchmakingService, $leagueService)
    {
        $matches = $matchmakingService->getScheduledMatches($week->number);
        $results = [];

        foreach ($matches as $match) {
            $result = $matchmakingService->play($match);
            $result['week'] = $week->id;
            $results[] = $this->match->create($result)->load(['firstTeam', 'secondTeam']);
            $leagueService->updateMatchLeaderboard($result);
        }

        $this->week->setPlayed($week->id);

        return $results;
    }
}
