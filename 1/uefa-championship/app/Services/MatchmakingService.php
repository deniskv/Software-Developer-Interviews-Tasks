<?php


namespace App\Services;


use App\Repositories\Interfaces\TeamsInterface;

class MatchmakingService
{
    /**
     * @var TeamsInterface
     */
    private $team;

    public function __construct(TeamsInterface $team)
    {
        $this->team = $team;
    }

    public function getScheduledMatches(int $week_number): array
    {
        $teams = $this->team->getTeamsIds();

        $matches = $this->scheduler($teams);

        return $matches[$week_number - 1] ?? [];
    }

    public function play(array $match): array
    {
        $home_team = $this->team->find($match['home']);
        $away_team = $this->team->find($match['away']);
        $home_goals = rand(0, ($home_team->strength / 20));
        $away_goals = rand(0, ($away_team->strength / 20) - 1);

        return [
            'first_team' => $home_team['id'],
            'second_team' => $away_team['id'],
            'first_team_goals' => $home_goals,
            'second_team_goals' => $away_goals,
        ];
    }

    protected function scheduler($teams): array
    {
        if (count($teams) % 2 != 0) {
            array_push($teams, "bye");
        }
        $away = array_splice($teams, (count($teams) / 2));
        $home = $teams;
        $round = [];
        $k = 0;
        for ($i = 0; $i < count($home) + count($away) - 1; $i++) {
            for ($j = 0; $j < count($home); $j++) {
                if ($k%2 == 0) {
                    $round[$i][$j]["home"] = $home[$j];
                    $round[$i][$j]["away"] = $away[$j];
                } else {
                    $round[$i][$j]["home"] = $away[$j];
                    $round[$i][$j]["away"] = $home[$j];
                }
                $k++;
            }
            if (count($home) + count($away) - 1 > 2) {
                $arr = array_splice($home, 1, 1);
                array_unshift($away, array_shift($arr));
                array_push($home, array_pop($away));
            }
        }

        $rounds = count($round);
        for ($i = 0; $i < $rounds; $i++) {
            $data = [];
            foreach ($round[$i] as $item) {
                array_push($data, ['home' => $item['away'], 'away' => $item['home']]);
            }
            $round[$rounds + $i] = $data;
        }

        return $round;
    }
}
