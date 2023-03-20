<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserFollowServiceContract;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function sprintf;

final class UnfollowUserController extends AbstractController
{
    public function __invoke(User $user, UserFollowServiceContract $userFollow): Response
    {
        $userFollow->unFollow($user);

        return new JsonResponse([
            'message' => sprintf('You unfollowed %s', $user->getAttribute('name')),
        ], Response::HTTP_OK);
    }
}
