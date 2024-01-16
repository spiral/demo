<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use Spiral\Bootloader\DomainBootloader;
use Spiral\Core\CoreInterface;
use Spiral\Cycle\Interceptor\CycleInterceptor;
use Spiral\DataGrid\Interceptor\GridInterceptor;
use Spiral\Domain\GuardInterceptor;

/**
 * @link https://spiral.dev/docs/http-interceptors
 */
final class AppBootloader extends DomainBootloader
{
    protected const SINGLETONS = [CoreInterface::class => [self::class, 'domainCore']];

    protected const INTERCEPTORS = [
        CycleInterceptor::class,
        GridInterceptor::class,
        GuardInterceptor::class,
    ];
}
