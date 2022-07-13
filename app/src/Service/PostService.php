<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Service;

use App\Database\Post;
use App\Database\User;
use Cycle\ORM\EntityManagerInterface;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'postService')]
class PostService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function createPost(User $user, string $title, string $content): Post
    {
        $post = new Post();
        $post->author = $user;
        $post->title = $title;
        $post->content = $content;

        $this->entityManager->persist($post);
        $this->entityManager->run();

        return $post;
    }
}
