<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $Category = Category::find(4);
        $Category->users()->create([
            'first_name' => 'Root',
            'last_name'  => 'Seventh',
            'email'      => 'root@seventh.com',
            'password'   => Hash::make('123123'),
            'document'   => '',
        ]);
    }
}
