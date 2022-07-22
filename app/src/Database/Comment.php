<?php

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation;

#[Entity]
class Comment
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $message,

        #[Relation\BelongsTo(target: User::class, nullable: false)]
        public User $author,

        #[Relation\BelongsTo(target: Post::class, nullable: false)]
        public Post $post
    ) {
    }
}
