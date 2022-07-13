<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault00ce2a110bd0587d5e1244b05381e9f6 extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('posts')
            ->addColumn('author_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["author_id"], [
                'name'   => 'posts_index_author_id_5e760a7aef925',
                'unique' => false
            ])
            ->addForeignKey(["author_id"], 'users', ["id"], [
                'name'   => 'posts_foreign_author_id_5e760a7aef933',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->update();
        
        $this->table('comments')
            ->addColumn('author_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('post_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["author_id"], [
                'name'   => 'comments_index_author_id_5e760a7ae86e6',
                'unique' => false
            ])
            ->addIndex(["post_id"], [
                'name'   => 'comments_index_post_id_5e760a7aef96d',
                'unique' => false
            ])
            ->addForeignKey(["author_id"], 'users', ["id"], [
                'name'   => 'comments_foreign_author_id_5e760a7ae87de',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->addForeignKey(["post_id"], 'posts', ["id"], [
                'name'   => 'comments_foreign_post_id_5e760a7aef99d',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->update();
    }

    public function down()
    {
        $this->table('comments')
            ->dropForeignKey(["author_id"])
            ->dropForeignKey(["post_id"])
            ->dropIndex(["author_id"])
            ->dropIndex(["post_id"])
            ->dropColumn('author_id')
            ->dropColumn('post_id')
            ->update();
        
        $this->table('posts')
            ->dropForeignKey(["author_id"])
            ->dropIndex(["author_id"])
            ->dropColumn('author_id')
            ->update();
    }
}
