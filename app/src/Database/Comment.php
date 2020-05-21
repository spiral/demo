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
 * @Cycle\Entity()
 */
class Comment
{
    /**
     * @Cycle\Column(type = "primary")
     */
    public $id;

    /**
     * @Cycle\Column(type = "string")
     */
    public $message;

    /**
     * @Cycle\Relation\BelongsTo(target = "User", nullable = false)
     * @var User
     */
    public $author;

    /**
     * @Cycle\Relation\BelongsTo(target = "Post", nullable = false)
     * @var User
     */
    public $post;
}
