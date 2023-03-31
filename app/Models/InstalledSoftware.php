<?php

namespace App\Models;

use App\Http\Traits\Observable;
use App\Http\Traits\ParentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstalledSoftware extends Model
{
    use HasFactory;
    use ParentTrait;
    use Observable;

    protected $table = 'installed_softwares';

    protected $guarded = [];

    public $rules =
        [
        ];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function asset()
    {
        return $this->belongsTo(Location::class, 'asset_id');
    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        InstalledSoftware::where('asset_id',$request->asset_id)->delete();
        if (isset($request->asset_id)) $item->asset_id = $request->asset_id;
        if (isset($request->software_id) && is_array($request->software_id)){
            foreach ($request->software_id as $softwareId){
                InstalledSoftware::create([
                    'software_id' => $softwareId,
                    'asset_id' => $request->asset_id,
                ]);
            }
        }
        if (isset($request->software_id)) $item->software_id = $request->software_id;

//        $item->save();
        return $item;
    }
}
