<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'username' => 'root',
            'password' => bcrypt('123456'),
        ]);

        $role = \App\Models\Role::create([
            'name' => 'root',
            'display_name' => '超级管理员'
        ]);

        $user->assignRole($role);

        $permissions = [
            [
                'name' => 'system',
                'display_name' => '系统管理',
                'child' => [
                    [
                        'name' => 'system.permissions',
                        'display_name' => '权限管理',
                        'child' => [
                            ['name' => 'system.permissions.create', 'display_name' => '添加'],
                            ['name' => 'system.permissions.edit', 'display_name' => '编辑'],
                            ['name' => 'system.permissions.destroy', 'display_name' => '删除'],
                        ]
                    ],
                    [
                        'name' => 'system.roles',
                        'display_name' => '角色管理',
                        'child' => [
                            ['name' => 'system.roles.create', 'display_name' => '添加'],
                            ['name' => 'system.roles.edit', 'display_name' => '编辑'],
                            ['name' => 'system.roles.destroy', 'display_name' => '删除'],
                            ['name' => 'system.roles.permission', 'display_name' => '分配权限'],
                        ]
                    ],
                    [
                        'name' => 'system.user',
                        'display_name' => '用户管理',
                        'child' => [
                            ['name' => 'system.users.create', 'display_name' => '添加'],
                            ['name' => 'system.users.edit', 'display_name' => '编辑'],
                            ['name' => 'system.users.resetPassword', 'display_name' => '重置密码'],
                            ['name' => 'system.users.status', 'display_name' => '启用/禁用'],
                            ['name' => 'system.users.destroy', 'display_name' => '删除'],
                        ]
                    ]
                ],
            ],
            [
                'name' => 'crm',
                'display_name' => 'CRM管理',
                'child' => [
                    [
                        'name' => 'crm.departments',
                        'display_name' => '部门管理',
                        'child' => [
                            ['name' => 'crm.departments.create', 'display_name' => '添加'],
                            ['name' => 'crm.departments.edit', 'display_name' => '编辑'],
                            ['name' => 'crm.departments.destroy', 'display_name' => '删除'],
                        ]
                    ],
                    [
                        'name' => 'crm.business',
                        'display_name' => '经理库',
                        'child' => [
                            ['name' => 'crm.business.to', 'display_name' => '分配'],
                        ]
                    ],
                    [
                        'name' => 'crm.waste',
                        'display_name' => '公海库',
                        'child' => [
                            ['name' => 'crm.waste.retrieve', 'display_name' => '拾回'],
                            ['name' => 'crm.waste.show', 'display_name' => '详情'],
                            ['name' => 'crm.waste.destroy', 'display_name' => '删除'],
                        ]
                    ],
                    [
                        'name' => 'crm.patients',
                        'display_name' => '客户管理',
                        'route' => 'crm.customer',
                        'child' => [
                            ['name' => 'crm.patients.create', 'display_name' => '添加'],
                            ['name' => 'crm.patients.edit', 'display_name' => '编辑'],
                            ['name' => 'crm.patients.destroy', 'display_name' => '删除'],
                            ['name' => 'crm.patients.show', 'display_name' => '详情'],
                            ['name' => 'crm.patients.remark', 'display_name' => '备注跟进'],
                            ['name' => 'crm.patients.list_all', 'display_name' => '查看所有客户'],
                            ['name' => 'crm.patients.list_department', 'display_name' => '查看本部门客户'],
                            ['name' => 'crm.patients.transfer', 'display_name' => '移交'],
                            ['name' => 'crm.patients.remove', 'display_name' => '剔除'],
                        ]
                    ],
                ],
            ]
        ];

        foreach ($permissions as $pem1) {
            //生成一级权限
            $p1 = \App\Models\Permission::create([
                'name' => $pem1['name'],
                'display_name' => $pem1['display_name'],
                'parent_id' => 0,
            ]);
            //为角色添加权限
            $role->givePermissionTo($p1);
            //为用户添加权限
            $user->givePermissionTo($p1);
            if (isset($pem1['child'])) {
                foreach ($pem1['child'] as $pem2) {
                    //生成二级权限
                    $p2 = \App\Models\Permission::create([
                        'name' => $pem2['name'],
                        'display_name' => $pem2['display_name'],
                        'parent_id' => $p1->id,
                    ]);
                    //为角色添加权限
                    $role->givePermissionTo($p2);
                    //为用户添加权限
                    $user->givePermissionTo($p2);
                    if (isset($pem2['child'])) {
                        foreach ($pem2['child'] as $pem3) {
                            //生成三级权限
                            $p3 = \App\Models\Permission::create([
                                'name' => $pem3['name'],
                                'display_name' => $pem3['display_name'],
                                'parent_id' => $p2->id,
                            ]);
                            //为角色添加权限
                            $role->givePermissionTo($p3);
                            //为用户添加权限
                            $user->givePermissionTo($p3);
                        }
                    }
                }
            }
        }
    }
}
