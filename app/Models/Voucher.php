<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Voucher extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'details',
        'country'
    ];

    protected $appends = [
        'image'
    ];

    protected $hidden = [
        'media'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(250);
    }

    protected function getImageAttribute(){
        $media = $this->getFirstMedia();
        return [
            'original' => $media->original_url,
            'thumb' => $media->getUrl('thumb')
        ];
    }
}
