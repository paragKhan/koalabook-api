<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Tags\Tag;

class ProcessCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private  $categories, $type;

    /**
     * Create a new job instance.
     */
    public function __construct($categories, $type)
    {
        $this->categories = $categories;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->categories as $category){
            if(!$this->type::withAnyTagsOfAnyType($category)->count()){
                Tag::findFromString($category, $this->type)->delete();
            }
        }
    }
}
