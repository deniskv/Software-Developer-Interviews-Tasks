<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Collection;

class PredictionsService
{
    public function predict(Collection $league): array
    {
        $first_team_points = optional($league->first())->ponits + 0;
        $result = [];
        for ($i = 1; $i <= config('app.num_of_trials'); $i++) {
            foreach ($league as $team) {
                $points_margin = $first_team_points - $team->points;
                $result[$team->team->name] = $result[$team->team->id] ?? 0;
                $result[$team->team->name] +=
                    rand(($team->team->strength - $points_margin - $team->played) / 2, $team->team->strength);
            }
        }

        foreach ($result as $key => $value) {
            $result[$key] = $value / config('app.num_of_trials');
        }

        $sum = array_sum($result);
        foreach ($result as $key => $value) {
            $result[$key] = $value / $sum * 100;
        }

        arsort($result, SORT_NUMERIC);

        return $result;
    }
}
