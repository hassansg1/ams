<?php

namespace App\Repos;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserIdRepo
{
    //
    public $query;

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function filter($query, $request)
    {
        $this->query = $query;

        $this->applyFilterOtcmUser($request);

        return $this->query;
    }

    public function applyFilterOtcmUser($request)
    {
        $locations = getUserLocations();
        $users = User::where('user_type', 'SYSTEM-USER');
        $users = $users->whereIn('unit_id', $locations)->pluck('id')->toArray();
//        $this->query
    }
}
