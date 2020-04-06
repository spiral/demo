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
use Cycle\ORM\TransactionInterface;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="commentService")
 */
class CommentService
{
    private $tr;

    public function __construct(TransactionInterface $tr)
    {
        $this->tr = $tr;
    }

    public function comment(Post $post, User $user, string $message): Comment
    {
        $comment = new Comment();
        $comment->post = $post;
        $comment->author = $user;
        $comment->message = $message;

        $this->tr->persist($comment);
        $this->tr->run();

        return $comment;
    }
}
