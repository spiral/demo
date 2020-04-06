<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
declare(strict_types=1);


namespace App\Bootloader;


use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Nyholm\ResponseFactory;

class PSRBootloader extends Bootloader
{
    protected const SINGLETONS = [
        ServerRequestFactoryInterface::class => Psr17Factory::class,
        ResponseFactoryInterface::class      => ResponseFactory::class,
        StreamFactoryInterface::class        => Psr17Factory::class,
        UploadedFileFactoryInterface::class  => Psr17Factory::class,
        UriFactoryInterface::class           => Psr17Factory::class,
    ];
}
