<?php

namespace Theomessin\Stalker;

use Illuminate\Database\Eloquent\Model;

class StalkerEntry extends Model
{
    protected $guarded = [];

    public function stalkable()
    {
        return $this->morphTo('stalkable');
    }

    public function setStalkableAttribute($stalkable)
    {
        if ($stalkable === null) return;
        $this->attributes['stalkable_id'] = $stalkable->id;
        $this->attributes['stalkable_type'] = get_class($stalkable);
        $this->setRelation('stalkable', $stalkable);
    }
}
