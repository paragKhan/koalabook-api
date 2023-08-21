<?php

namespace App\Policies;

use App\Models\ListeningBook;
use App\Models\User;

class ListeningBookPolicy
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
    public function view(?User $user, ListeningBook $listeningBook): bool
    {
        if($listeningBook->subscription_type == 'free')
            return true;

        return $user && $user->subscribed;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ListeningBook $listeningBook): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ListeningBook $listeningBook): bool
    {
        return false;
    }
}
