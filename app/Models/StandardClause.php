<?php

namespace App\Models;

use App\Http\Traits\Observable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class StandardClause extends Model
{
    use HasFactory;
    use Observable;
    use NodeTrait;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function rules($standardId = null)
    {
        return [
//            'number' => 'required|unique:clauses,number,NULL,id,standard_id,' . $standardId,
        ];
    }

    protected $appends = ['text'];

    public function getEnfAttribute()
    {
        return "1";
    }

    public function getTextAttribute()
    {
        return "<span class='num'>$this->number</span>" . "    " . $this->title;
    }

    protected $guarded = [];

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    /**
     * @param $item
     * @param $request
     * @return mixed
     */
    public function saveFormData($item, $request)
    {
        if (isset($request->parent)) {
            $parent = StandardClause::where("number", $request->parent)->where('standard_id', $request->standard_id)->first();
        }

        if (isset($request->number)) $item->number = $request->number;
        if (isset($request->title)) $item->title = $request->title;
        if (isset($request->description)) $item->description = $request->description;
        if (isset($request->standard_id)) $item->standard_id = $request->standard_id;
        if (isset($request->security_control_rating)) $item->security_control_rating = $request->security_control_rating;
        if (isset($request->applicable)) $item->applicable = $request->applicable == "Yes" || $request->applicable == 1 ? 1 : null;
        if (isset($request->location)) $item->location = $request->location;
        if (isset($request->is_heading)) $item->is_heading = $request->is_heading == "Yes" ? 1 : 0;


        $item->save();

        if (isset($request->parent) && $parent) {
            $parent->appendNode($item);
        } else {
            $item->saveAsRoot();
        }

        StandardClause::fixtree();
        return $item;
    }

    public function isApplicable()
    {
        if (count($this->descendants) == 0) return $this->applicable == 1;

        return $this->descendants->where('applicable', 1)->count() > 0;
    }

    public function isApplicableOnLocationType($types)
    {
        if (empty($types)) return true;

        if (count($this->descendants) == 0) return in_array($this->location, $types) == 1;

        return $this->descendants->whereIn('location', $types)->count() > 0;
    }
}
