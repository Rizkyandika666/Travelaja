<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $adminRole 	= Role::where('name','admin')->first();
        $userRole 	= Role::where('name','user')->first();

        $admin = User::create([
        	'name'	=> 'admin',
        	'email'	=> 'Admin@gmail.com',
        	'password' => bcrypt('admin'),
            'telepon'   => 1231312,
            'jenis_kelamin'   => 'L',
            'alamat'   => 'purwosari',
            'no_ktp'   => 1231312
        ]);

        $user = User::create([
        	'name'	=> 'user',
        	'email'	=> 'User@user.com',
        	'password'	=> bcrypt('user'),
            'telepon'   => 1231312,
            'jenis_kelamin'   => 'L',
            'alamat'   => 'purwosari',
            'no_ktp'   => 1231312
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
