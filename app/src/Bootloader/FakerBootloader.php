<?php

declare(strict_types=1);


namespace App\Bootloader;

use Faker\Factory;
use Faker\Generator;
use Spiral\Boot\Bootloader\Bootloader;

class FakerBootloader extends Bootloader
{
    protected const SINGLETONS = [
        Generator::class => [self::class, 'fakerGenerator']
    ];

    private function fakerGenerator(): Generator
    {
        return Factory::create(Factory::DEFAULT_LOCALE);
    }
}
