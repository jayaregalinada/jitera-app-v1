<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserFollowServiceContract;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function sprintf;

final class FollowUserController extends AbstractController
{
    public function __invoke(User $user, UserFollowServiceContract $userFollowService): Response
    {
        $userFollowService->follow($user);

        return new JsonResponse([
            'message' => sprintf('You are now following %s', $user->getAttribute('name')),
        ], Response::HTTP_CREATED);
    }
}
