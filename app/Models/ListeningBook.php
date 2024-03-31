<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class ListeningBook extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia;

    protected $fillable = [
        'title',
        'subscription_type',
        'text',
        'playable_url'
    ];

    protected $appends = [
        'categories',
        'cover_image'
    ];

    protected $hidden = [
        'media'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100);
    }

    protected function getCoverImageAttribute(){
        $media = $this->getFirstMedia();
        return [
            'original' => $media->original_url,
            'thumb' => $media->getUrl('thumb')
        ];
    }

    protected function getCategoriesAttribute(){
        return $this->tags()->pluck('name');
    }
}
