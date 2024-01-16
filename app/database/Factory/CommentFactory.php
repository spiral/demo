<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\Comment;
use App\Database\Post;
use App\Database\User;
use Faker\Generator;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class CommentFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Comment::class;
    }

    /**
     * Returns an entity
     */
    public function makeEntity(array $definition): Comment
    {
        return new Comment($definition['message'], $definition['author'], $definition['post']);
    }

    /**
     * Generate Comment with given author
     */
    public function withAuthor(User $author): self
    {
        return $this->state(fn(Generator $faker, array $definition) => [
            'author' => $author,
        ]);
    }

    /**
     * Generate Comment with given post
     */
    public function withPost(Post $post): self
    {
        return $this->state(fn(Generator $faker, array $definition) => [
            'post' => $post,
        ]);
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(12),
            'author' => UserFactory::new()->makeOne(),
            'post' => PostFactory::new()->makeOne()
        ];
    }
}
