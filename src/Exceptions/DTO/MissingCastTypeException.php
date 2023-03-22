<?php

namespace Stepanenko3\LaravelApiSkeleton\Exceptions\DTO;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class MissingCastTypeException extends Exception
{
    public function __construct(string $property)
    {
        parent::__construct("Missing cast type configuration for property: {$property}", Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
