<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory(10)->create();
        $admin = \App\Models\Admin::find(1);
        $admin->username = 'admin';
        $admin->password = bcrypt('admin');
        $admin->save();
    }
}
