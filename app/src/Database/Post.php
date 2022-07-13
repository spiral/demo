<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Database;

use App\Repository\PostRepository;
use Cycle\Annotated\Annotation as Cycle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[Cycle\Entity(repository: PostRepository::class)]
class Post
{
    #[Cycle\Column(type: 'primary')]
    public int $id;

    #[Cycle\Column(type: 'string')]
    public string $title;

    #[Cycle\Column(type: 'text')]
    public string $content;

    #[Cycle\Relation\BelongsTo(target: User::class, nullable: false)]
    public User $author;

    /**
     * @var Collection|Comment[]
     * @psalm-var Collection<int, Comment>
     */
    #[Cycle\Relation\HasMany(target: Comment::class)]
    public Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
}
