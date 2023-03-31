<?php

namespace App\Models;


use App\Http\Traits\Observable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
	use HasFactory, Observable;

	public $rules =
	[
		'name' => 'required |unique:rights',
	];

    public function right_type(){
        return $this->hasOne(AssetFunction::class, 'id', 'asset_function');
    }

	public function saveFormData($item, $request)
	{
        if ($request->user_type == "asset") {
            if (isset($request->parent_id)) $item->parent_id = $request->parent_id;
            $item->parent = $request->user_type;
        }else{
            if (isset($request->system_id)) $item->parent_id = $request->system_id;
            $item->parent = $request->user_type;

        }
		if (isset($request->name)) $item->name = $request->name;
		if (isset($request->description)) $item->description = $request->description;
		$item->save();
		return $item;
	}
}
