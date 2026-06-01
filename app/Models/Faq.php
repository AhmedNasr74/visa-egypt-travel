<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Traits\Models\AutoTranslate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Faq extends Model
{

    use Translatable, AutoTranslate;

    protected $fillable=[
        'category_id',
        'enabled',
        'home',
        'important'

    ];
    public array $translatedAttributes = [
        'question',
        'answer'
    ];
    protected $casts = [
        'enabled' => 'boolean',
        'important' => 'boolean',
        'home' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->BelongsTo(FaqCategory::class,'category_id');
    }

}
