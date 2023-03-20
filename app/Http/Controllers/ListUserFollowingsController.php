<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Filters\FilterByName;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class ListUserFollowingsController extends AbstractController
{
    public function __invoke(Request $request, FilterByName $filterByName): Responsable
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = $request->user();

        return UserResource::collection(
            $currentUser
                ->followings()
                ->with(['address', 'company'])
                ->latest()
                ->when($request->has('name'), $filterByName)
                ->paginate($request->query('per_page'))
                ->appends($request->query())
        );
    }
}