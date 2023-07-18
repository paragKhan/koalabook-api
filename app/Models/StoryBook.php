<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class StoryBook extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia;

    protected $fillable = [
        'title',
        'subscription_type'
    ];

    protected $appends = [
        'categories',
        'cover_image'
    ];

    protected $hidden = [
        'media'
    ];

    protected function getCategoriesAttribute()
    {
        return $this->tags()->pluck('name');
    }

    protected function getCoverImageAttribute()
    {
        return $this->getFirstMediaUrl();
        //return $this->getFirstTemporaryUrl(now()->addMinute(1)); //for s3
    }

    public function pages(){
        return $this->morphMany(Page::class, 'pageable');
    }
}
