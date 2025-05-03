<?php

namespace Database\Seeders;

use App\Models\Bin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bin::factory()->count(15)->create();
    }
}
