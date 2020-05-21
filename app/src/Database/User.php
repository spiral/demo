<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;

/**
 * @Cycle\Entity(repository = "App\Repository\UserRepository")
 */
class User
{
    /**
     * @Cycle\Column(type = "primary")
     */
    public $id;

    /**
     * @Cycle\Column(type = "string")
     */
    public $name;
}
