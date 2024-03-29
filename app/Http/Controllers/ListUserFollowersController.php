<?php

namespace App\Http\Controllers;

use App\Http\Filters\FilterByName;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class ListUserFollowersController extends AbstractController
{
    public function __invoke(Request $request, FilterByName $filterByName): Responsable
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = $request->user();

        return UserResource::collection(
            $currentUser
                ->followers()
                ->with(['address', 'company'])
                ->latest() // Always sort the latest follower
                ->when($request->has('name'), $filterByName) // When ?name is provided in query params, use the FilterByName
                ->paginate($request->query('per_page'))
                ->appends($request->query())
        );
    }
}
