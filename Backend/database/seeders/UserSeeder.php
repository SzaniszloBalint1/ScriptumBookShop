<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/datas/users.json'));
        $users = json_decode($json, true);
        foreach ($users as &$user) {
            $user['password'] = Hash::make($user['password']);
        }
        DB::table('users')->insert($users);
    }
}
