<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class GetCurrentUserController extends AbstractController
{
    public function __invoke(Request $request): Responsable
    {
        return new UserResource($request->user());
    }
}
