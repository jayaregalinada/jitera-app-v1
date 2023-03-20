<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class UnableToFollowAlreadyFollowedException extends HttpException
{
    public static function new(): self
    {
        return new self(Response::HTTP_FORBIDDEN, 'Unable to follow already followed user');
    }
}