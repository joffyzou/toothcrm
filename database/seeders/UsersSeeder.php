<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $user = User::find(1);
        $user->username = 'admin';
        $user->password = bcrypt('admin');
        $user->role_id = 1;
        $user->is_admin = 1;
        $user->save();
    }
}
