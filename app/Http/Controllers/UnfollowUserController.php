<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserFollowServiceContract;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function sprintf;

final class UnfollowUserController extends AbstractController
{
    public function __invoke(Request $request, User $user, UserFollowServiceContract $userFollow): Response
    {
        $userFollow->unFollow($user);

        return new JsonResponse([
            'message' => sprintf('You unfollowed %s', $user->getAttribute('name')),
        ], Response::HTTP_OK);
    }
}
