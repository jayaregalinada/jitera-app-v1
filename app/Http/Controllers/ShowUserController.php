<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;

final class ShowUserController extends AbstractController
{
    public function __invoke(User $user): Responsable
    {
        return new UserResource($user);
    }
}
