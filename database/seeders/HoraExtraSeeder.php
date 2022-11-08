<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoraExtraSeeder extends Seeder
{
    public function run()
    {
        \App\Models\HoraExtra::factory(30)->create();
    }
}
