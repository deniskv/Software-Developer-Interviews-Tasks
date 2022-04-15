<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LeagueInterface;
use App\Repositories\Interfaces\WeekInterface;
use App\Services\PredictionsService;


class PredictionsController extends Controller
{
    /**
     * @var LeagueInterface
     */
    private $league;
    /**
     * @var WeekInterface
     */
    private $week;

    public function __construct(LeagueInterface $league, WeekInterface $week)
    {
        $this->league = $league;
        $this->week = $week;
    }

    public function __invoke(PredictionsService $service)
    {
        $league = $this->league->all(['team']);

        try {
            $this->week->getUpcomingWeek();
        } catch (\Exception $e) {
            // League is over
            $leaderboard = [];
            foreach ($league as $key => $team) {
                $leaderboard[$team->team->name] = ($key == 0 ? 100 : 0);
            }
            arsort($leaderboard, SORT_NUMERIC);

            return response()->json([
                'predictions' => $leaderboard
            ]);
        }


        return response()->json([
            'predictions' => $service->predict($league)
        ]);
    }
}
