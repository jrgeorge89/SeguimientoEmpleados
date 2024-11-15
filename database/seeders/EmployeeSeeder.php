<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()
            ->count(3)
            // ->hasCategory(1)
            ->create();
        Employee::factory()
            ->count(4)
            // ->hasCategory(1)
            ->create();
        Employee::factory()
            ->count(5)
            // ->hasCategory(1)
            ->create();
    }
}
