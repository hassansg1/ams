<?php

namespace App\Models;

use App\Http\Traits\Observable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskRating extends Model
{
    protected $table = 'risk_rating';

    protected $guarded = [];
}
