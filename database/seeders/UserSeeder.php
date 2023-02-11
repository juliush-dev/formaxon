<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::IS_ADMIN
        ]);

        User::create([
            'name' => 'Company User',
            'email' => 'company@example.com',
            'company_name' => 'Company name',
            'password' => Hash::make('password'),
            'role_id' => Role::IS_COMPANY
        ]);

        User::create([
            'name' => 'Assistent User',
            'email' => 'assistent@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::IS_ASSISTANT
        ]);
    }
}