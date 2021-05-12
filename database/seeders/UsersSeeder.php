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
        $user->is_admin = true;
        $user->role_id = 0;
        $user->p_id = 0;
        $user->save();
    }
}
