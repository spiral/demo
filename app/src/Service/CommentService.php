<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Service;

use App\Database\Comment;
use App\Database\Post;
use App\Database\User;
use Cycle\ORM\EntityManagerInterface;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'commentService')]
class CommentService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function comment(Post $post, User $user, string $message): Comment
    {
        $comment = new Comment($message, $user, $post);

        $this->entityManager->persist($comment);
        $this->entityManager->run();

        return $comment;
    }
}
