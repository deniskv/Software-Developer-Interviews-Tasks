<?php


namespace App\Services;


use App\Repositories\Interfaces\LeagueInterface;

class LeagueService
{
    /**
     * @var LeagueInterface
     */
    private $league;

    public function __construct(LeagueInterface $league)
    {
        $this->league = $league;
    }

    public function updateMatchLeaderboard(array $result)
    {
        $stats = $this->getTeamMatchStatistics($result['first_team_goals'], $result['second_team_goals']);

        $first_team = $this->league->getTeam($result['first_team']);
        $first_team->update([
            'points' => $stats['first_team_points'] + $first_team->points,
            'played' => ++$first_team->played,
            'win' => $stats['first_team_won'] + $first_team->won,
            'lose' => $stats['first_team_lost'] + $first_team->lost,
            'draw' => $stats['first_team_draw'] + $first_team->draw,
            'goal_diff' => $result['first_team_goals'] - $result['second_team_goals'] + $first_team->goal_difference,
        ]);

        $second_team = $this->league->getTeam($result['second_team']);
        $second_team->update([
            'points' => $stats['second_team_points'] + $second_team->points,
            'played' => ++$second_team->played,
            'win' => $stats['second_team_won'] + $second_team->won,
            'lose' => $stats['second_team_lost'] + $second_team->lost,
            'draw' => $stats['second_team_draw'] + $second_team->draw,
            'goal_diff' => $result['second_team_goals'] - $result['first_team_goals'] + $second_team->goal_difference,
        ]);
    }

    protected function getTeamMatchStatistics(int $first_team_goals, int $second_team_goals): array
    {
        $stats = [
            'first_team_points' => 0,
            'first_team_won' => 0,
            'first_team_lost' => 0,
            'first_team_draw' => 0,
            'second_team_points' => 0,
            'second_team_won' => 0,
            'second_team_lost' => 0,
            'second_team_draw' => 0,
        ];

        if ($first_team_goals > $second_team_goals) {
            $stats['first_team_points'] = 3;
            $stats['first_team_won'] = 1;
            $stats['second_team_lost'] = 1;
        } elseif ($first_team_goals == $second_team_goals) {
            $stats['first_team_points'] = 1;
            $stats['first_team_draw'] = 1;
            $stats['second_team_points'] = 1;
            $stats['second_team_draw'] = 1;
        } else {
            $stats['second_team_points'] = 3;
            $stats['second_team_won'] = 1;
            $stats['first_team_lost'] = 1;
        }

        return $stats;
    }
}
