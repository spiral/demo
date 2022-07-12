<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Command\Seed;

use App\Database\Comment;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Cycle\ORM\EntityManagerInterface;
use Faker\Generator;
use Spiral\Console\Command;

class CommentCommand extends Command
{
    protected const NAME = 'seed:comment';

    protected function perform(
        Generator $faker,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        PostRepository $postRepository
    ): int {
        $users = $userRepository->findAll();
        $posts = $postRepository->findAll();

        for ($i = 0; $i < 1000; $i++) {
            $user = $users[array_rand($users)];
            $post = $posts[array_rand($posts)];

            $comment = new Comment();
            $comment->author = $user;
            $comment->post = $post;
            $comment->message = $faker->sentence(12);

            $this->sprintf("New comment: <info>%s</info>\n", $comment->message);

            $entityManager->persist($comment);
            $entityManager->run();
        }

        return self::SUCCESS;
    }
}
