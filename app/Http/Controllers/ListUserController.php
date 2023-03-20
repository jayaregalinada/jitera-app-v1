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
                ->with(['address', 'company']) // Eager loaded the Address and Company
                ->latest('updated_at') // Always sort any latest update
                ->paginate($request->query('per_page')) // Paginate by per_page query params
                ->appends($request->query()) // Add any other parameters
        );
    }
}
