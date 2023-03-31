<?php

namespace App\Models;

use App\Http\Traits\Observable;
use App\Scopes\LocationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Activitylog\LogOptions;

class Computer extends Model
{
    use HasFactory;

//    use Observable;
    use NodeTrait;


    protected $table = 'locations';

    public static $type = 'computer';

    public static $repo = 'ComputerRepo';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        return static::addGlobalScope(new LocationScope(self::$type));
    }

    public $rules =
        [
            'rec_id' => 'required | unique:locations,rec_id',
        ];

    protected $appends = ['show_name'];

    public function getShowNameAttribute()
    {
        return $this->name;
    }


    public function ports()
    {
        return $this->hasMany(Port::class, 'location_id');
    }


    /**
     * @param $value
     */
    public function setCategoryAttribute($value)
    {
        if (!is_numeric($value) || AssetCategories::find($value) == null) {
            $value = AssetCategories::createNew($value);
        }
        $this->attributes['category'] = $value;
    }

    /**
     * @param $value
     */
//    public function setFunctionAttribute($value)
//    {
//        if (!is_numeric($value) || AssetFunction::find($value) == null) {
//            $value = AssetFunction::createNew($value);
//        }
//        $this->attributes['function'] = $value;
//    }

    /**
     * @param $value
     */
//    public function setMakeAttribute($value)
//    {
//        if (!is_numeric($value) || AssetMake::find($value) == null) {
//            $value = AssetMake::createNew($value);
//        }
//        $this->attributes['make'] = $value;
//    }

    /**
     * @param $value
     */
    public function setSecurityZoneAttribute($value)
    {
        if (!is_numeric($value) || AssetSecurityZone::find($value) == null) {
            $value = AssetSecurityZone::createNew($value);
        }
        $this->attributes['security_zone'] = $value;
    }

//    public function asset_function(){
//        return $this->belongsTo(AssetFunction::class, 'function', 'id');
//    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request, $saveNow = true)
    {
        if (isset($request->name)) $item->name = $request->name;
        if (isset($request->rec_id)) $item->rec_id = $request->rec_id;
        if (isset($request->description)) $item->description = $request->description;
        if (isset($request->function)) $item->function = $request->function;
        if (isset($request->make)) $item->make = $request->make;
        if (isset($request->model)) $item->model = $request->model;
        if (isset($request->part_number)) $item->part_number = $request->part_number;
        if (isset($request->serial_number)) $item->serial_number = $request->serial_number;
        if (isset($request->security_zone)) $item->security_zone = $request->security_zone;
        if (isset($request->client_description)) $item->client_description = $request->client_description;
        if (isset($request->vm_host)) $item->vm_host = $request->vm_host;
        if (isset($request->operating_system)) $item->operating_system = $request->operating_system;
        if (isset($request->connected_scada_server)) $item->connected_scada_server = $request->connected_scada_server;
        if (isset($request->contact)) $item->contact = $request->contact;
        if (isset($request->comment)) $item->comment = $request->comment;

        if (isset($request->hardware_legacy)) $item->hardware_legacy = $request->hardware_legacy;
        if (isset($request->software_legacy)) $item->software_legacy = $request->software_legacy;
        if (isset($request->single_point_of_failure)) $item->single_point_of_failure = $request->single_point_of_failure;
        if (isset($request->criticality)) $item->criticality = $request->criticality;

        if ($saveNow) {
            $item->save();
            $item->type = self::$type;
            $parent = Location::find($request->parent_id);
            if (isset($request->ports)) {
                Port::updatePorts($item, $request->ports);
            }
            $newItem = Location::find($item->id);
            $parent->appendNode($newItem);
            Location::fixtree();
        } else {
            $item->type = self::$type;
            return $item;
        }

        return $item;
    }
}
