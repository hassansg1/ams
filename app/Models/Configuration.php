<?php

namespace App\Models;

use App\Http\Traits\Observable;
use App\Scopes\LocationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $guarded = [];
}
