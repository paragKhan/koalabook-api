<?php

namespace App\Models;

use App\Services\BeyondWords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'text',
        'audio_id',
        'project_id',
        'audio_url',
    ];

    protected $appends = [
        'image'
    ];

    protected $hidden = [
        'media'
    ];

    protected function getImageAttribute()
    {
        return $this->getFirstMediaUrl();
        //return $this->getFirstTemporaryUrl(now()->addMinute(1)); //for s3
    }

    public function book(){
        return $this->morphTo('pageable');
    }

    public function retriveAudioUrl(){
        $audio_url = null;
        switch(get_class($this->book)){
            case StoryBook::class:
                $audio_url = BeyondWords::storyBook()->retriveAudioUrl($this->audio_id);
                break;
            case ListeningBook::class:
                $audio_url = BeyondWords::listeningBook()->retriveAudioUrl($this->audio_id);
                break;
        }
        $this->audio_url = $audio_url;
        $this->save();
    }
}
