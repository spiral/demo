<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\PostRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[Entity(repository: PostRepository::class)]
class Post
{
    #[Column(type: 'primary')]
    public int $id;

    #[Column(type: 'string')]
    public string $title;

    #[Column(type: 'text')]
    public string $content;

    #[Relation\BelongsTo(target: User::class, nullable: false)]
    public User $author;

    /**
     * @var Collection|Comment[]
     * @psalm-var Collection<int, Comment>
     */
    #[Relation\HasMany(target: Comment::class)]
    public Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
}
