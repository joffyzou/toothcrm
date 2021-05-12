<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'is_admin' => true,
                'role_id' => 0,
                'p_id' => 0,
                'remember_token' => Str::random(10),
                'created_at' => new Carbon,
                'updated_at' => new Carbon
            ]
        ];
        DB::table('users')->insert($users);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
    }
}
