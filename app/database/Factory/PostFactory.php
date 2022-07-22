<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\Post;
use App\Database\User;
use Faker\Generator;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class PostFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Post::class;
    }

    /**
     * Returns an entity
     */
    public function makeEntity(array $definition): Post
    {
        return new Post($definition['title'], $definition['content'], $definition['author']);
    }

    public function withAuthor(User $author): self
    {
        return $this->state(fn(Generator $faker, array $definition) => [
            'author' => $author,
        ]);
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(12),
            'content' => $this->faker->text(900),
            'author' => UserFactory::new()->makeOne()
        ];
    }
}
