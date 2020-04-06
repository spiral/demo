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
use Cycle\ORM\TransactionInterface;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="postService")
 */
class PostService
{
    private $tr;

    public function __construct(TransactionInterface $tr)
    {
        $this->tr = $tr;
    }

    public function createPost(User $user, string $title, string $content): Post
    {
        $post = new Post();
        $post->author = $user;
        $post->title = $title;
        $post->content = $content;

        $this->tr->persist($post);
        $this->tr->run();

        return $post;
    }
}
