<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'tour_id',
        'client_id',
        'blog_id',
        'comment',
        'email',
        'first_name',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
