<?php

namespace Database\Seeders;

use SenventhCode\ConsoleService\App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = User::create([
            'first_name' => 'Root',
            'last_name'  => 'Seventh',
            'email'      => 'root@seventh.com',
            'password'   => Hash::make('123123'),
            'document'   => '',
        ]);        
    }
}
