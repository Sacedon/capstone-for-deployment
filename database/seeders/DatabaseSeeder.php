<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'surname' => 'HR',
            'first_name' => 'Administrator',
            'password' => bcrypt('password'), // Hash the password using Bcrypt
            'role' => 'admin',
        ]);

        $departments = ['COE', 'CON', 'CCJ', 'CABM-M', 'CABM-H', 'CAST'];

        foreach ($departments as $departmentName) {
            $department = Department::create(['name' => $departmentName]);

            // Create a supervisor head account
            User::create([
                'username' => Str::slug($departmentName . ' HEAD'),
                'surname' => $departmentName . ' HEAD',
                'first_name' => 'Supervisor',
                'password' => bcrypt('password'), // Set a default password
                'role' => 'supervisor',
                'department_id' => $department->id,
            ]);
        }

        // Create 10 employee accounts using the factory
        \App\Models\User::factory(50)->create();
    }
}
