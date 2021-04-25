<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(10)->create();
        $admin = Admin::find(1);
        $admin->username = 'admin';
        $admin->role_id = 1;
        $admin->password = bcrypt('admin');
        $admin->save();
    }
}
