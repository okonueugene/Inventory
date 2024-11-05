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
            ['name' => 'John Doe', 'department' => 'IT', 'designation' => 'Software Engineer', 'location' => 'New York','user_id' => 1],
            ['name' => 'Jane Doe', 'department' => 'HR', 'designation' => 'HR Manager', 'location' => 'Los Angeles', 'user_id' => 2],
            ['name' => 'Mark Doe', 'department' => 'Finance', 'designation' => 'Finance Manager', 'location' => 'Chicago', 'user_id' => 1],
            ['name' => 'Chris Doe', 'department' => 'IT', 'designation' => 'System Administrator', 'location' => 'Houston' ,'user_id' => 2],
            ['name' => 'Sara Doe', 'department' => 'HR', 'designation' => 'HR Executive', 'location' => 'Phoenix', 'user_id' => 1],
            ['name' => 'Mike Doe', 'department' => 'Finance', 'designation' => 'Finance Executive', 'location' => 'Philadelphia', 'user_id' => 2],
        ];

        foreach ($employees as $employee) {
            \App\Models\Employee::create($employee);
        }
    }
}
