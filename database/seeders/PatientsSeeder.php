<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Patient::factory(80)->create();
    }
}
