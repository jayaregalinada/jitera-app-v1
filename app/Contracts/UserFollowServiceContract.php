<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\User;

interface UserFollowServiceContract
{
    /**
     * Follow the $user and return $user when successful
     */
    public function follow(User $user): User;

    /**
     * Unfollow the $user and return $user when successful
     */
    public function unFollow(User $user): User;
}