<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\LeagueInterface;
use App\Repositories\Interfaces\MatchInterface;
use App\Repositories\Interfaces\TeamsInterface;
use App\Repositories\Interfaces\WeekInterface;
use App\Repositories\LeagueRepository;
use App\Repositories\MatchRepository;
use App\Repositories\TeamsRepository;
use App\Repositories\WeekRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LeagueInterface::class, LeagueRepository::class);
        $this->app->bind(MatchInterface::class, MatchRepository::class);
        $this->app->bind(WeekInterface::class, WeekRepository::class);
        $this->app->bind(TeamsInterface::class, TeamsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
