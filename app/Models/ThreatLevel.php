<?php

namespace App\Models;

use App\Http\Traits\Observable;
use App\Scopes\LocationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ThreatLevel extends Model
{
    protected $table = 'threat_level_definition';

    protected $guarded = [];
}
