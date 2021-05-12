<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repay;

class RepaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repay::factory(139)->create();
    }
}
