<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class ColoringBook extends Model implements HasMedia
{
    use HasFactory, HasTags, InteractsWithMedia;

    protected $fillable = [
        'subscription_type'
    ];

    protected $appends = [
        'categories',
        'image'
    ];

    protected $hidden = [
        'media'
    ];

    protected function getImageAttribute(){
        return $this->getFirstMediaUrl();
    }

    protected function getCategoriesAttribute(){
        return $this->tags()->pluck('name');
    }
}
