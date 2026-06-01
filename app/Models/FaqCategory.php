<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Traits\Models\AutoTranslate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class FaqCategory extends Model
{
    use Translatable, AutoTranslate;
    public array $translatedAttributes = [
        'title',
    ];
    protected $translationForeignKey = 'category_id';
    public $timestamps = false;
    public function faq():HasMany
    {
        return $this->HasMany(Faq::class);
    }

}
