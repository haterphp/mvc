<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $rows = [
            'id'    => 1,
            'username'  => 'admin',
            'email'  => 'admin@info.com',
            'password'  => password_hash("admin", PASSWORD_DEFAULT),
            'role_id'  => 1,
        ];

        $this->table('users')->insert($rows)->save();
    }
}
