<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        Language::create([
            'language' => 'Português',
            'default'  => true,
            'code'     => 'pt-br',
        ]);

        Language::create([
            'language' => 'Inglês',
            'default'  => false,
            'code'     => 'en',
        ]);
    }
}
