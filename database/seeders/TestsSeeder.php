<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => '管理员'
            ], [
                'name' => 'manager',
                'display_name' => '经理'
            ], [
                'name' => 'staff',
                'display_name' => '员工'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('123456')
            ], [
                'username' => 'test',
                'password' => bcrypt('123456')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
