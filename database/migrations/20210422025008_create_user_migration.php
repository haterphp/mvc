<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserMigration extends AbstractMigration
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
        $table = $this->table('users');
        $table
            ->addColumn('username', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('role_id', 'integer')
            ->addIndex(['email'], ['unique' => true])
            ->addForeignKey('role_id', 'roles', 'id', ['delete' => 'CASCADE'])
            ->create();

        if($this->isMigratingUp()){
            $rows = [
                'id'    => 1,
                'username'  => 'admin',
                'email'  => 'admin@info.com',
                'password'  => md5('admin'),
                'role_id'  => 1,
            ];

            $this->table('users')->insert($rows)->save();
        }
    }

    public function down(): void
    {
        $this->dropTable('users');
    }
}
