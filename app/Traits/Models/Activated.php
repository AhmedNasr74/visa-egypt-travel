<?php

namespace App\Traits\Models;

use App\Scopes\Activated as Scope;
use Illuminate\Database\Eloquent\Builder;

trait Activated
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new Scope);
    }

    public function scopeActive(Builder $query): Builder
    {
        $table = $query->getModel()->getTable();

        return $query->where($table . '.active', true);
    }
}
