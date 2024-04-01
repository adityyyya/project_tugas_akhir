<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '083144951386',
            'password' => Hash::make('admin'),
            'role' => Role::ADMIN->status(),
        ]);
        User::factory()->create([
            'name' => 'Muhamad Aditya',
            'email' => 'aditya@admin.com',
            'phone' => '083144951386',
            'password' => Hash::make('admin'),
            'role' => Role::STAFF->status(),
        ]);
    }
    
}
