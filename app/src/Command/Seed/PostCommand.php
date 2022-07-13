<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Command\Seed;

use App\Repository\UserRepository;
use App\Service\PostService;
use Faker\Generator;
use Spiral\Console\Command;

class PostCommand extends Command
{
    protected const NAME = 'seed:post';

    public function __construct(
        private UserRepository $userRepository,
        private PostService $postService,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function perform(Generator $faker): int
    {
        $users = $this->userRepository->findAll();

        for ($i = 0; $i < 1000; $i++) {
            $user = $users[array_rand($users)];

            $post = $this->postService->createPost(
                $user,
                $faker->sentence(12),
                $faker->text(900)
            );

            $this->sprintf("New post: <info>%s</info>\n", $post->title);
        }

        return self::SUCCESS;
    }
}
