<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class TestAutoIdDisabledSnapshot56 extends AbstractMigration
{
    public $autoId = false;

    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up(): void
    {
        $this->table('articles')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'comment' => 'Article title',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('note', 'string', [
                'default' => '7.4',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('counter', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'category_id',
                ]
            )
            ->addIndex(
                [
                    'product_id',
                ]
            )
            ->addIndex(
                [
                    'title',
                ]
            )
            ->create();

        $this->table('categories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'slug',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('composite_pks')
            ->addColumn('id', 'uuid', [
                'default' => 'a4950df3-515f-474c-be4c-6a027c1957e7',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => '',
                'limit' => 10,
                'null' => false,
            ])
            ->addPrimaryKey(['id', 'name'])
            ->create();

        $this->table('orders')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('product_category', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('product_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'product_category',
                    'product_id',
                ]
            )
            ->create();

        $this->table('parts')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('number', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
            ])
            ->create();

        $this->table('products')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('category_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'slug',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'category_id',
                    'id',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'category_id',
                ]
            )
            ->addIndex(
                [
                    'title',
                ],
                ['type' => 'fulltext']
            )
            ->create();

        $this->table('special_pks')
            ->addColumn('id', 'uuid', [
                'default' => 'a4950df3-515f-474c-be4c-6a027c1957e7',
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 256,
                'null' => true,
            ])
            ->create();

        $this->table('special_tags')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('article_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('author_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('highlighted', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('highlighted_time', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'article_id',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('texts')
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 256,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 256,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('updated', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('articles')
            ->addForeignKey(
                'category_id',
                'categories',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION',
                ]
            )
            ->addForeignKey(
                'product_id',
                'products',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->update();

        $this->table('orders')
            ->addForeignKey(
                [
                    'product_category',
                    'product_id',
                ],
                'products',
                [
                    'category_id',
                    'id',
                ],
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->update();

        $this->table('products')
            ->addForeignKey(
                'category_id',
                'categories',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down(): void
    {
        $this->table('articles')
            ->dropForeignKey(
                'category_id'
            )
            ->dropForeignKey(
                'product_id'
            )->save();

        $this->table('orders')
            ->dropForeignKey(
                [
                    'product_category',
                    'product_id',
                ]
            )->save();

        $this->table('products')
            ->dropForeignKey(
                'category_id'
            )->save();

        $this->table('articles')->drop()->save();
        $this->table('categories')->drop()->save();
        $this->table('composite_pks')->drop()->save();
        $this->table('orders')->drop()->save();
        $this->table('parts')->drop()->save();
        $this->table('products')->drop()->save();
        $this->table('special_pks')->drop()->save();
        $this->table('special_tags')->drop()->save();
        $this->table('texts')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
