<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RepaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Repay::factory(300)->create();
    }
}
