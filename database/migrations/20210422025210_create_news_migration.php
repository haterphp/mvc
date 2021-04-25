<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNewsMigration extends AbstractMigration
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
        $table = $this->table('newses');
        $table
            ->addColumn('title', 'string')
            ->addColumn('description', 'string')
            ->addColumn('image', 'string', ['null' => true])
            ->addTimestamps()
            ->create();
    }

    public function down(): void
    {
        $this->dropTable('newses');
    }
}
