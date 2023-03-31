<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAssets extends Model
{
    use HasFactory;
    public function system_assets(){
        return $this->belongsTo(Location::class, 'asset_id', 'id');
    }
}
