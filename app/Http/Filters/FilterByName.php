<?php

declare(strict_types=1);

namespace App\Http\Filters;

use App\Contracts\FilterContract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use function request;

final class FilterByName implements FilterContract
{
    public function __invoke(Builder $builder): void
    {
        $builder->where('name', 'LIKE', '%' . request('name') . '%');
    }
}