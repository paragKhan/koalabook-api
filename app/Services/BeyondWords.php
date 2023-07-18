<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class BeyondWords
{
    protected $client;

    public function __construct($project_id)
    {
        $this->project_id = $project_id;
        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('BEYOND_WORDS_API_KEY')
        ];

        $this->client = new Client(['headers' => $headers]);
    }

    public static function storyBook(){
        return new BeyondWords(env('STORY_BOOK_ID'));
    }

    public static function listeningBook(){
        return new BeyondWords(env('LISTENING_BOOK_ID'));
    }

    public function retriveAudioUrl($audio_id){
        $uri = "https://app.beyondwords.io/api/v4/projects/".$this->project_id."/audio/".$audio_id;

        $response = $this->client->get($uri);
        $media = json_decode($response->getBody()->getContents())->media;

        return collect($media)->filter(function($item){
            return Str::contains($item->url, '.mp3');
        })->first()->url;
    }


}
