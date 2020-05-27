<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
    DB::table('users')->insert([
      'name' => 'Manager',
      'role' => 1,
      'username' => 'manager',
      'password' => Hash::make('manager'),
      'code' => 'xx1',
      'benefit' => 0,
      'suspend' => 0,
      'delete' => 0,
    ]);

    DB::table('users')->insert([
      'name' => 'HRD',
      'role' => 2,
      'username' => 'hrd',
      'password' => Hash::make('hrd'),
      'code' => 'xx2',
      'benefit' => 0,
      'suspend' => 0,
      'delete' => 0,
    ]);

    DB::table('users')->insert([
      'name' => 'super visor',
      'role' => 3,
      'username' => 'spv',
      'password' => Hash::make('spv'),
      'code' => 'xx3',
      'benefit' => 0,
      'suspend' => 0,
      'delete' => 0,
    ]);

    DB::table('users')->insert([
      'name' => 'ADMIN',
      'role' => 4,
      'username' => 'admin',
      'password' => Hash::make('admin'),
      'code' => 'xx4',
      'benefit' => 0,
      'suspend' => 0,
      'delete' => 0,
    ]);

    DB::table('users')->insert([
      'name' => 'user 1',
      'role' => 5,
      'username' => 'user',
      'password' => Hash::make('user'),
      'code' => 5,
      'benefit' => 0,
      'suspend' => 0,
      'delete' => 0,
    ]);
  }
}
