<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['name' => 'John Doe', 'department' => 'IT', 'designation' => 'Software Engineer', 'location' => 'New York'],
            ['name' => 'Jane Doe', 'department' => 'HR', 'designation' => 'HR Manager', 'location' => 'Los Angeles'],
            ['name' => 'Mark Doe', 'department' => 'Finance', 'designation' => 'Finance Manager', 'location' => 'Chicago'],
            ['name' => 'Chris Doe', 'department' => 'IT', 'designation' => 'System Administrator', 'location' => 'Houston'],
            ['name' => 'Sara Doe', 'department' => 'HR', 'designation' => 'HR Executive', 'location' => 'Phoenix'],
        ];

        foreach ($employees as $employee) {
            \App\Models\Employee::create($employee);
        }
    }
}
