<?php

namespace Database\Seeders;

use App\Models\Department;
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

        $departments = [
            [
                'name' => '客服部',
            ], [
                'name' => '运营部'
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('123456')
            ], [
                'username' => '杨玉笛',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '董佳龙',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '李鑫',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '张璘',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '吕彤',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '邢超杰',
                'password' => bcrypt('123456'),
                'department_id' => 1
            ], [
                'username' => '李娜',
                'password' => bcrypt('123456'),
                'department_id' => 2
            ], [
                'username' => '李靖双',
                'password' => bcrypt('123456'),
                'department_id' => 2
            ], [
                'username' => '杜鹏飞',
                'password' => bcrypt('123456'),
                'department_id' => 2
            ], [
                'username' => '刘慧婷',
                'password' => bcrypt('123456'),
                'department_id' => 2
            ], [
                'username' => '李阳',
                'password' => bcrypt('123456'),
                'department_id' => 2
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
