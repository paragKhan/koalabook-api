<?php

namespace App\Policies;

use App\Models\ColoringBook;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ColoringBookPolicy
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
    public function view(?User $user, ColoringBook $coloringBook): bool
    {
        if($coloringBook->subscription_type == 'free')
            return true;

        return $user && $user->can('view-paid-book');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create-book');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ColoringBook $coloringBook): bool
    {
        return $user->can('update-book');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ColoringBook $coloringBook): bool
    {
        return $user->can('delete-book');
    }
}
