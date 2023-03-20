<?php

declare(strict_types=1);

namespace App\Contracts;


use Illuminate\Contracts\Database\Eloquent\Builder;

interface FilterContract
{
    public function __invoke(Builder $builder): void;
}