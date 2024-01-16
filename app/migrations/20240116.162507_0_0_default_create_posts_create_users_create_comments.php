<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault0c765545d9f9512726ec9da39c432774 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('posts')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('title', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('content', 'text', ['nullable' => false, 'default' => null])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('users')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('name', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('comments')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('message', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('comments')->drop();
        $this->table('users')->drop();
        $this->table('posts')->drop();
    }
}
