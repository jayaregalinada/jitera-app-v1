<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class ListUserController extends AbstractController
{
    public function __invoke(Request $request): Responsable
    {
        return UserResource::collection(
            User::query()
                ->with(['address', 'company'])
                ->latest('updated_at')
                ->paginate($request->query('per_page'))
                ->appends($request->query())
        );
    }
}
