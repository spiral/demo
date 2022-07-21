<?php

declare(strict_types=1);

namespace App\Command\Seed;

use App\Database\User;
use Cycle\ORM\EntityManagerInterface;
use Faker\Generator;
use Spiral\Console\Command;

class UserCommand extends Command
{
    protected const NAME = 'seed:user';

    protected function perform(EntityManagerInterface $em, Generator $faker): int
    {
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->name = $faker->name;

            $em->persist($user);
        }

        $em->run();

        $this->output->write('<info>Database seeding completed successfully.</info>');

        return self::SUCCESS;
    }
}
