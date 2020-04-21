<?php

namespace Theomessin\Stalker;

trait HasStalkerEntries
{
    public function stalkerEntries()
    {
        return $this->morphMany(StalkerEntry::class, 'stalkable');
    }
}
