<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WeekInterface;

class WeeksController extends Controller
{
    /**
     * @var WeekInterface
     */
    private $week;

    public function __construct(WeekInterface $week)
    {
        $this->week = $week;
    }

    public function current()
    {
        return response()->json([
            'week' => $this->week->getCurrentWeek(),
        ]);
    }
}
