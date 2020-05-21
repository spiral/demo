<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App;

use App\Bootloader;
use Spiral\Bootloader as Framework;
use Spiral\DataGrid\Bootloader as DataGrid;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Framework\Kernel;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\Nyholm\Bootloader as Nyholm;
use Spiral\Prototype\Bootloader as Prototype;
use Spiral\Router\Bootloader as Router;
use Spiral\Scaffolder\Bootloader as Scaffolder;
use Spiral\Stempler\Bootloader as Stempler;

class App extends Kernel
{
    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected const LOAD = [
        // Base extensions
        DotEnv\DotenvBootloader::class,
        Monolog\MonologBootloader::class,
        Bootloader\LoggingBootloader::class,

        // Core Services
        Framework\SnapshotsBootloader::class,

        // Security and validation
        Framework\Security\ValidationBootloader::class,
        Framework\Security\FiltersBootloader::class,
        Framework\Security\GuardBootloader::class,

        // HTTP extensions
        Nyholm\NyholmBootloader::class,
        Framework\Http\RouterBootloader::class,
        Framework\Http\JsonPayloadsBootloader::class,
        Framework\Http\ErrorHandlerBootloader::class,

        // Databases
        Framework\Database\DatabaseBootloader::class,
        Framework\Database\MigrationsBootloader::class,

        // ORM
        Framework\Cycle\CycleBootloader::class,
        Framework\Cycle\ProxiesBootloader::class,
        Framework\Cycle\AnnotatedBootloader::class,

        // Views and view translation
        Framework\Views\ViewsBootloader::class,

        // Additional dispatchers
        Framework\Jobs\JobsBootloader::class,

        // Extensions and bridges
        Stempler\StemplerBootloader::class,

        // Framework commands
        Framework\CommandBootloader::class,

        // Debug and debug extensions
        Framework\DebugBootloader::class,
        Framework\Debug\LogCollectorBootloader::class,
        Framework\Debug\HttpCollectorBootloader::class,

        DataGrid\GridBootloader::class,
        Router\AnnotatedRoutesBootloader::class,

        Bootloader\AppBootloader::class,
        Bootloader\FakerBootloader::class,

        // fast code prototyping
        Prototype\PrototypeBootloader::class,
        Scaffolder\ScaffolderBootloader::class,
    ];
}
