<?php

declare(strict_types=1);

namespace Database\Seeder;

use Database\Factory\CommentFactory;
use Database\Factory\PostFactory;
use Database\Factory\UserFactory;
use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;

class BlogSeeder extends AbstractSeeder
{
    public function run(): \Generator
    {
        $users = UserFactory::new()->times(100)->make();
        yield from $users;

        $posts = [];
        for ($i = 0; $i < 1000; $i++) {
            $posts[] = PostFactory::new()
                ->withAuthor($users[array_rand($users)])
                ->makeOne();
        }
        yield from $posts;

        for ($i = 0; $i < 1000; $i++) {
            yield CommentFactory::new()
                ->withAuthor($users[array_rand($users)])
                ->withPost($posts[array_rand($posts)])
                ->makeOne();
        }
    }
}
