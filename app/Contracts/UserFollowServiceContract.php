<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\User;

interface UserFollowServiceContract
{
    public function follow(User $user): User;

    public function unFollow(User $user): User;
}