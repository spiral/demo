<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Repository;

use App\Database\Post;
use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;

class PostRepository extends Repository
{
    public function findAllWithAuthor(): Select
    {
        return $this->select()->load('author');
    }

    public function findOneWithComments(string $id): ?Post
    {
        return $this
            ->select()
            ->wherePK($id)
            ->load('author')
            ->load(
                'comments.author',
                [
                    'load' => function (Select\QueryBuilder $q): void {
                        // last comments at top
                        $q->orderBy('id', 'DESC');
                    }
                ]
            )
            ->fetchOne();
    }
}
