<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\User;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class UserFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return User::class;
    }

    /**
     * Returns an entity
     */
    public function makeEntity(array $definition): User
    {
        return new User($definition['name']);
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
