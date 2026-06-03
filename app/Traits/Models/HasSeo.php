<?php

namespace App\Traits\Models;

use App\Models\Seo;
use App\Support\SiteSeo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seo');
    }

    public function publish(): void
    {
        SiteSeo::fromSeoable($this);
    }
}
