<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use Spiral\Bootloader\Http\RoutesBootloader as BaseRoutesBootloader;
use Spiral\Debug\Middleware\DumperMiddleware;
use Spiral\Debug\StateCollector\HttpCollector;
use Spiral\Filter\ValidationHandlerMiddleware;
use Spiral\Http\Middleware\ErrorHandlerMiddleware;
use Spiral\Http\Middleware\JsonPayloadMiddleware;
use Spiral\Router\Bootloader\AnnotatedRoutesBootloader;

/**
 * A bootloader that configures the application's routes and middleware.
 *
 * @link https://spiral.dev/docs/http-routing
 */
final class RoutesBootloader extends BaseRoutesBootloader
{
    protected const DEPENDENCIES = [AnnotatedRoutesBootloader::class];

    protected function globalMiddleware(): array
    {
        return [
            ErrorHandlerMiddleware::class,
            DumperMiddleware::class,
            JsonPayloadMiddleware::class,
            HttpCollector::class,
        ];
    }

    protected function middlewareGroups(): array
    {
        return [
            'web' => [
                ValidationHandlerMiddleware::class
            ],
        ];
    }
}
