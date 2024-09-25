<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortUrl extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'url',
        'short_url'
    ];

    public function getFullShortUrlAttribute(): string
    {
        return sprintf('%s/%s', config('app.url_domain'), $this->short_url);
    }
}
