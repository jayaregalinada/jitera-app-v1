<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserFollowServiceContract;
use App\Exceptions\UnableToFollowAlreadyFollowedException;
use App\Exceptions\UnableToFollowCurrentUserException;
use App\Exceptions\UnableToUnfollowUserException;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Validation\UnauthorizedException;

final class UserFollowService implements UserFollowServiceContract
{
    public function __construct(private readonly Factory $auth)
    {
    }

    public function follow(User $user): User
    {
        $this->validateCurrentUser($user);

        if ($this->isFollowing($user)) {
            throw UnableToFollowAlreadyFollowedException::new();
        }

        $this
            ->getCurrentUser()
            ->followings()
            ->attach($user);

        return $user;
    }

    public function unFollow(User $user): User
    {
        $this->validateCurrentUser($user);

        if ($this->isFollowing($user) === false) {
            throw UnableToUnfollowUserException::new();
        }

        $this
            ->getCurrentUser()
            ->followings()
            ->detach($user);

        return $user;
    }

    private function getCurrentUser(): User
    {
        if ($this->auth->guard()->hasUser() === false) {
            throw new UnauthorizedException();
        }

        /** @var \App\Models\User $currentUser */
        $currentUser = $this->auth->guard()->user();

        return $currentUser;
    }

    private function isFollowing(User $user): bool
    {
        return $this->getCurrentUser()->followings->contains($user);
    }

    private function validateCurrentUser(User $user): void
    {
        if ($user->getAttribute('id') === $this->getCurrentUser()->getAttribute('id')) {
            throw UnableToFollowCurrentUserException::new();
        }
    }
}