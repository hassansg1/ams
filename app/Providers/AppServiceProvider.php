<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\StandardClause;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            File::append(
                storage_path('/logs/sql.log'),
                $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
            );
        });

        StandardClause::updated(function ($standardClause) {
            Cache::forget('clauseCached' . $standardClause->standard_id);
        });

        StandardClause::created(function ($standardClause) {
            Cache::forget('clauseCached' . $standardClause->standard_id);
        });

        StandardClause::deleted(function ($standardClause) {
            Cache::forget('clauseCached' . $standardClause->standard_id);
        });

        Location::deleted(function () {
            Location::fixtree();
        });
    }
}
