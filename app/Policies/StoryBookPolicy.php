<?php

namespace App\Policies;

use App\Models\StoryBook;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StoryBookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, StoryBook $storyBook): bool
    {
        if($storyBook->subscription_type == 'free')
            return true;

        return $user && $user->subscribed();

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $storyBook): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StoryBook $storyBook): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StoryBook $storyBook): bool
    {
        return false;
    }
}
