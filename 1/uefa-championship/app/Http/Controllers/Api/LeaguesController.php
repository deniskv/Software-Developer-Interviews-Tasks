<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LeagueInterface;
use App\Http\Resources\LeagueResource;
use Illuminate\Http\Request;

class LeaguesController extends Controller
{
    /**
     * @var LeagueInterface
     */
    private $league;

    public function __construct(LeagueInterface $league)
    {
        $this->league = $league;
    }

    public function index(Request $request)
    {
        $league = $this->league->all(['team']);

        return response()->json([
            'league' => LeagueResource::collection($league)
        ]);
    }
}
