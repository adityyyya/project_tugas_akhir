<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
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
        $user = New User();
        $user -> name = 'Administrator';
        $user -> email = 'admin@gmail.com';
        $user -> password = Hash::make('admin');
        $user -> level = 'Admin';
        $user -> save();
    }
    
}
