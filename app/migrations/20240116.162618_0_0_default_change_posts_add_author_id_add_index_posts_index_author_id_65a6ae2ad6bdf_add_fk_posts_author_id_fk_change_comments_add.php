<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault3eb1d6cf0e0aa642e0d93a2c99ce3aa9 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('posts')
        ->addColumn('author_id', 'integer', ['nullable' => false, 'default' => null])
        ->addIndex(['author_id'], ['name' => 'posts_index_author_id_65a6ae2ad6bdf', 'unique' => false])
        ->addForeignKey(['author_id'], 'users', ['id'], [
            'name' => 'posts_author_id_fk',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->update();
        $this->table('comments')
        ->addColumn('post_id', 'integer', ['nullable' => false, 'default' => null])
        ->addColumn('author_id', 'integer', ['nullable' => false, 'default' => null])
        ->addIndex(['post_id'], ['name' => 'comments_index_post_id_65a6ae2ad6b26', 'unique' => false])
        ->addIndex(['author_id'], ['name' => 'comments_index_author_id_65a6ae2ad6bf8', 'unique' => false])
        ->addForeignKey(['post_id'], 'posts', ['id'], [
            'name' => 'comments_post_id_fk',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->addForeignKey(['author_id'], 'users', ['id'], [
            'name' => 'comments_author_id_fk',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->update();
    }

    public function down(): void
    {
        $this->table('comments')
        ->dropForeignKey(['post_id'])
        ->dropForeignKey(['author_id'])
        ->dropIndex(['post_id'])
        ->dropIndex(['author_id'])
        ->dropColumn('post_id')
        ->dropColumn('author_id')
        ->update();
        $this->table('posts')
        ->dropForeignKey(['author_id'])
        ->dropIndex(['author_id'])
        ->dropColumn('author_id')
        ->update();
    }
}
