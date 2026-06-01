<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Use only on {@see \Illuminate\Database\Eloquent\Model} subclasses (e.g. translation models).
 *
 * @phpstan-require-extends \Illuminate\Database\Eloquent\Model
 *
 * @method static void registerModelEvent(string $event, \Closure|string $callback)
 */
trait TranslateOnUpdate
{
    protected static function bootTranslateOnUpdate(): void
    {
        static::registerModelEvent('saved', function (Model $translation): void {
            if (! method_exists($translation, 'translationFKName')) {
                return;
            }

            $fk = $translation->translationFKName();
            $parentId = $translation->getAttribute($fk);

            if (! $parentId) {
                return;
            }

            $base = str_replace('Translation', '', class_basename($translation));
            $parentClass = 'App\\Models\\' . $base;

            if (! class_exists($parentClass)) {
                return;
            }

            if (! $translation->getConnection()->getSchemaBuilder()->hasColumn((new $parentClass)->getTable(), 'translated_at')) {
                return;
            }

            $parentClass::query()->whereKey($parentId)->update([
                'translated_at' => now(),
            ]);
        });
    }
}
