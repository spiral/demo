<?php

declare(strict_types=1);

namespace App\Endpoint\Web\View;

use App\Database\Post;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Attribute\Singleton;
use Spiral\Prototype\Annotation\Prototyped;
use Spiral\Prototype\Traits\PrototypeTrait;

#[Singleton]
#[Prototyped(property: 'postView')]
final class PostView
{
    use PrototypeTrait;

    public function map(Post $post): array
    {
        return [
            'post' => [
                'id'      => $post->id,
                'author'  => [
                    'id'   => $post->author->id,
                    'name' => $post->author->name
                ],
                'title'   => $post->title,
                'content' => $post->content,
            ]
        ];
    }

    public function json(Post $post): ResponseInterface
    {
        return $this->response->json($this->map($post), 200);
    }
}
