<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
      DB::table('roles')->insert([
        'role_name' => 'manager',
      ]);
      DB::table('roles')->insert([
        'role_name' => 'employee',
      ]);
    }
}
