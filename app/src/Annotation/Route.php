<?php

declare(strict_types=1);

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation()
 * @Annotation\Target({"METHOD"})
 * @Annotation\Attributes({
 *      @Annotation\Attribute("action", type="string", required=true),
 *      @Annotation\Attribute("verbs", type="array"),
 * })
 */
class Route
{
    /** @var string */
    public $action;

    /** @var string[]|null */
    public $verbs;
}
