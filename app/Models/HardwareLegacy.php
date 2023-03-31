<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareLegacy extends Model
{
    use HasFactory;

    protected $table = 'hardware_legacies';

    protected $guarded = [];

    public $rules =
        [
            'hardware_make' => 'required',
        ];

    public static function getTypeToModel($type)
    {
        $arr = self::getTypeArray();

        return $arr[$type] ?? '';
    }

    public static function getTypeArray()
    {
        return [
            'computer' => 'computer',
            'network' => 'network',
            'lone' => 'lone',
        ];
    }


    /**
     * @param $name
     * @param bool $returnId
     * @return mixed
     */
    /**
     * @param $value
     */

    public function saveFormData($item, $request)
    {
        if (isset($request->hardware_make)) $item->hardware_make = $request->hardware_make;
        if (isset($request->hardware_model)) $item->hardware_model = $request->hardware_model;
        if (isset($request->end_of_sale)) $item->end_of_sale = $request->end_of_sale;
        if (isset($request->end_of_sale)) $item->end_of_sale = $request->end_of_sale;
        if (isset($request->type)) $item->type = $request->type;
        if ($request->status == null){
            $item->status = null;
        }
        $item->save();
        return $item;
    }
}
