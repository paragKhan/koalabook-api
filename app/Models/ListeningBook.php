<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class ListeningBook extends Model implements HasMedia
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

    protected function getCoverImageAttribute(){
        return $this->getFirstMediaUrl();
    }
    protected function getCategoriesAttribute(){
        return $this->tags()->pluck('name');
    }

    public function page(){
        return $this->morphOne(Page::class, 'pageable');
    }
}
