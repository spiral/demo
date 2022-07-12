<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;

#[Cycle\Entity]
class Comment
{
    #[Cycle\Column(type: 'primary')]
    public int $id;

    #[Cycle\Column(type: 'string')]
    public string $message;

    #[Cycle\Relation\BelongsTo(target: User::class, nullable: false)]
    public User $author;

    #[Cycle\Relation\BelongsTo(target: Post::class, nullable: false)]
    public Post $post;
}
