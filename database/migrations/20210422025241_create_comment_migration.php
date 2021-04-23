<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCommentMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $table = $this->table('comments');
        $table
            ->addColumn('comment', 'string')
            ->addColumn('user_id', 'integer')
            ->addColumn('news_id', 'integer')
            ->addColumn('is_blocked', 'integer', ['default' => 0])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
            ->addForeignKey('news_id', 'newses', 'id', ['delete' => 'CASCADE'])
            ->addTimestamps()
            ->create();
    }

    public function down(): void
    {
        $this->dropTable('comments');
    }
}
