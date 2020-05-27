<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('salaries')->insert([
            'salary' => 58000,
            'over_time' => 7000,
            'benefit' => 10000,
        ]);
    }
}
